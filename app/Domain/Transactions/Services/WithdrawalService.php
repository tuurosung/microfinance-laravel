<?php

declare(strict_types= 1);

namespace App\Domain\Transactions\Services;

use App\Concerns\Accounts\GuardCustomerAccounts;
use App\Domain\Accounts\Models\Account;
use App\Domain\Transactions\Contracts\GatewayManagerInterface;
use App\Domain\Transactions\Contracts\LedgerInterface;
use App\Domain\Transactions\Contracts\WithdrawalServiceInterface;
use App\Domain\Transactions\Models\MomoTransaction;
use App\Domain\Transactions\Models\WithdrawalRequest;
use App\Domain\Transactions\Services\JournalEntry;
use App\DTOs\Gateway\MomoDisbursementData;
use App\DTOs\Transactions\WithdrawalData;
use App\Enums\Transactions\MomoDirectionEnum;
use App\Enums\Transactions\MomoTransactionStatusEnum;
use App\Enums\Transactions\TransactionChannelEnum;
use App\Enums\Transactions\WithdrawalRequestStatusEnum;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Override;

final class WithdrawalService implements WithdrawalServiceInterface
{
    use GuardCustomerAccounts;


    public function __construct(
        private readonly LedgerInterface $ledger,
        private readonly GatewayManagerInterface $gateway
    ) {}


    /**
     * Every withdrawal attempt creates a WithdrawalRequest row — including
     * ones that post immediately. That gives one audit surface for all
     * withdrawals regardless of channel or approval path.
     */
    public function request(Account $account, WithdrawalData $withdrawalData): WithdrawalRequest
    {
        $existing = WithdrawalRequest::where('idempotency_key', $withdrawalData->idempotencyKey)->first();
        if ($existing !== null) {
            return $existing;
        }


        $request = DB::transaction(function () use ($account, $withdrawalData): WithdrawalRequest {

            $account = Account::with(['gl', 'cif'])->lockForUpdate()->findOrFail($account->account_id);

            $this->guardWithdrawable($account);
            $this->guardBalanceCoversWithdrawal($account, $withdrawalData->amountPesewas);

            // dd($withdrawalData);

            $request = WithdrawalRequest::create([
                'reference'       => (string) Str::uuid(),
                'account_id'      => $account->account_id,
                'amount_pesewas'  => $withdrawalData->amountPesewas,
                'narration'       => $withdrawalData->narration,
                'channel'         => $withdrawalData->transactionChannel,
                'momo_provider'   => $withdrawalData->momoProvider,
                'wallet_number'   => $withdrawalData->walletNumber,
                'idempotency_key' => $withdrawalData->idempotencyKey,
                'maker_id'        => $withdrawalData->userId,
                'status'          => WithdrawalRequestStatusEnum::PendingApproval,
            ]);

            // dd($request);

            // if ($this->needsApproval($withdrawalData->amountPesewas)) {
            //     $this->holdFunds($request);
            //     AuditTrail::log($request, $withdrawalData->userId, 'WITHDRAWAL_REQUESTED', null, WithdrawalRequestStatusEnum::PendingApproval->value);

            //     return $request;
            // }

            if ($withdrawalData->transactionChannel === TransactionChannelEnum::Counter) {
                $this->postCounterWithdrawal($request);

                return $request;
            }

            // MoMo below threshold: hold funds now; the gateway call happens
            // after commit — never inside the DB transaction.
            $this->holdFunds($request);
            $request->update(['status' => WithdrawalRequestStatusEnum::AwaitingGateway]);

            return $request;
        });

        if ($this->shouldDispatchToGateway($request)) {
            $this->initiateTransfer($request);
        }

        return $request->refresh();
    }


    #[Override]
    public function approve(WithdrawalRequest $withdrawalRequest, int $userId): WithdrawalRequest
    {
        DB::transaction(function () use ($request, $checkerId): void {

            $request = WithdrawalRequest::lockForUpdate()->findOrFail($request->id);

            $this->guardDualControl($request, $checkerId);
            $this->guardPendingApproval($request);

            $request->update(['checker_id' => $checkerId, 'decided_at' => now()]);

            if ($request->channel === TransactionChannelEnum::Counter) {
                $this->releaseHold($request);
                $this->postCounterWithdrawal($request);

                AuditTrail::log($request, $checkerId, 'WITHDRAWAL_APPROVED', WithdrawalRequestStatusEnum::PendingApproval->value, WithdrawalRequestStatusEnum::Posted->value);

                return;
            }

            // MoMo: keep the lien until the provider confirms via webhook.
            $request->update(['status' => WithdrawalRequestStatusEnum::AwaitingGateway]);

            AuditTrail::log($request, $checkerId, 'WITHDRAWAL_APPROVED', WithdrawalRequestStatusEnum::PendingApproval->value, WithdrawalRequestStatusEnum::AwaitingGateway->value);
        });

        $request->refresh();

        if ($this->shouldDispatchToGateway($request)) {
            $this->initiateTransfer($request);
        }

        return $request->refresh();
    }


    #[Override]
    public function reject(WithdrawalRequest $withdrawalRequest, int $userId, string $reason): WithdrawalRequest
    {
        DB::transaction(function () use ($request, $checkerId, $reason): void {

            $request = WithdrawalRequest::lockForUpdate()->findOrFail($request->id);

            $this->guardDualControl($request, $checkerId);
            $this->guardPendingApproval($request);

            $this->releaseHold($request);

            $request->update([
                'status'           => WithdrawalRequestStatusEnum::Rejected,
                'checker_id'       => $checkerId,
                'decided_at'       => now(),
                'rejection_reason' => $reason,
            ]);

            AuditTrail::log($request, $checkerId, 'WITHDRAWAL_REJECTED', WithdrawalRequestStatusEnum::PendingApproval->value, WithdrawalRequestStatusEnum::Rejected->value, $reason);
        });

        return $request->refresh();
    }


    /**
     * Called by MomoSettlementService when the provider confirms the
     * disbursement. Releases the hold and posts the real ledger entry.
     */
    public function settleGatewaySuccess(WithdrawalRequest $withdrawalRequest): void
    {
        DB::transaction(function () use ($request): void {

            $request = WithdrawalRequest::lockForUpdate()->findOrFail($request->id);

            if ($request->status->isTerminal()) {
                return; // webhook replay — already settled
            }

            $this->releaseHold($request);

            $reference = $this->ledger->post(JournalEntry::withdrawal(
                customerAccountId: $request->account_id,
                payoutAccountId: Account::momoFloat($request->momo_provider)->id,
                amountPesewas: $request->amount_pesewas,
                narration: $request->narration ?? "MoMo withdrawal {$request->reference}",
                idempotencyKey: "momo-out-{$request->reference}",
                actorId: $request->maker_id,
                channel: TransactionChannelEnum::Momo,
            ));

            $request->update([
                'status'           => WithdrawalRequestStatusEnum::Posted,
                'ledger_reference' => $reference,
            ]);
        });
    }


    #[Override]
    public function settleGatewayFailure(WithdrawalRequest $withdrawalRequest, string $reason): void
    {
        DB::transaction(function () use ($request, $reason): void {

            $request = WithdrawalRequest::lockForUpdate()->findOrFail($request->id);

            if ($request->status->isTerminal()) {
                return;
            }

            $this->releaseHold($request);

            $request->update([
                'status'           => WithdrawalRequestStatusEnum::Failed,
                'rejection_reason' => $reason,
            ]);

            AuditTrail::log($request, $request->maker_id, 'WITHDRAWAL_GATEWAY_FAILED', null, WithdrawalRequestStatusEnum::Failed->value, $reason);
        });
    }


    // ── internals ────────────────────────────────────────────────────────

    private function needsApproval(int $amountPesewas): bool
    {
        return $amountPesewas >= (int) config('banking.withdrawal_approval_threshold_pesewas');
    }

    /**
     * Withdrawal must not breach the account's minimum balance:
     * available - amount >= minimum_balance.
     */
    private function guardBalanceCoversWithdrawal(Account $account, int $amountPesewas): void
    {
        $available = $this->ledger->balances($account)->availableBalancePesewas;

        if ($available - $amountPesewas < (int) $account->minimum_balance_pesewas) {
            throw new \DomainException(
                "Withdrawal would breach the minimum balance on {$account->account_number}."
            );
        }
    }


    private function guardDualControl(WithdrawalRequest $request, int $checkerId): void
    {
        if ($request->maker_id === $checkerId) {
            throw new \DomainException('Dual control violation: Maker cannot decide their own withdrawal request.');
        }
    }

    private function guardPendingApproval(WithdrawalRequest $request): void
    {
        if ($request->status !== WithdrawalRequestStatusEnum::PendingApproval) {
            throw new \DomainException("Withdrawal request must be pending approval; it is '{$request->status->value}'.");
        }
    }


    /**
     * Lien for the pending amount so the funds cannot be drained through
     * another channel between initiation and decision/settlement.
     */
    private function holdFunds(WithdrawalRequest $request): void
    {
        $lien = $request->account->liens()->create([
            'amount_pesewas' => $request->amount_pesewas,
            'status'         => 'active',
            'reason'         => "Withdrawal hold — {$request->reference}",
            'placed_by'      => $request->maker_id,
        ]);

        $request->update(['lien_id' => $lien->id]);
    }



    private function releaseHold(WithdrawalRequest $request): void
    {
        if ($request->lien_id === null) {
            return;
        }

        $request->lien()->update(['status' => 'released', 'released_at' => now()]);
    }


    public function postCounterWithdrawal(WithdrawalRequest $withdrawalRequest): void
    {
        $reference = $this->ledger->post(JournalEntry::withdrawal(
            customerAccountId: $withdrawalRequest->account_id,
            payoutAccountId: Account::cashTill()->account_id,
            amountPesewas: $withdrawalRequest->amount_pesewas,
            narration: $request->narration ?? 'Cash withdrawal',
            idempotencyKey: $withdrawalRequest->idempotency_key,
            userId: $withdrawalRequest->maker_id,
            channel: TransactionChannelEnum::Counter,
        ));

        $withdrawalRequest->update([
            'status'           => WithdrawalRequestStatusEnum::Posted,
            'ledger_reference' => $reference,
        ]);
    }


    public function shouldDispatchToGateway(WithdrawalRequest $withdrawalRequest): bool
    {
        return $withdrawalRequest->status === WithdrawalRequestStatusEnum::AwaitingGateway
            && $withdrawalRequest->momoTransaction()-doesntExist();
    }


    public function initiateTransfer(WithdrawalRequest $withdrawalRequest): void
    {
        $momoTransfer = MomoTransaction::create([
            'reference'=> (string) Str::uuid(),
            "direction" => MomoDirectionEnum::Disbursement,
            "provider" => $withdrawalRequest->momoProvider,
            "wallet_number" => $withdrawalRequest->wallet_number,
            "account_number" => $withdrawalRequest->accout_number,
            "withdrawal_request_id"=> $withdrawalRequest->request_id,
            "amount_pesewas"=> $withdrawalRequest->amount_pesewas,
            'narration'             => $withdrawalRequest->narration ?? "MoMo withdrawal {$withdrawalRequest->reference}",
            'status'                => MomoTransactionStatusEnum::Pending,
            'initiated_by'          => $withdrawalRequest->userId,
        ]);


        try {

            $result = $this->gateway->for($withdrawalRequest->momo_provider)
                ->transfer(new MomoDisbursementData(
                    walletNumber: $withdrawalRequest->wallet_number,
                    amountPesewas: $withdrawalRequest->amount_pesewas,
                    externalReference: $momoTransfer->reference,
                    narration: $momoTransfer->narration
                ));

        } catch (\Throwable $e) {
            $momoTransfer->update(['status' => MomoTransactionStatusEnum::Failed, 'failure_reason' => $e->getMessage()]);
            $this->settleGatewayFailure($withdrawalRequest, $e->getMessage());
            return;
        }

        if (!$result->accepted) {
            $momoTransfer->update(['status' => MomoTransactionStatusEnum::Failed, 'failure_reason' => $result->message]);
            $this->settleGatewayFailure($withdrawalRequest, $result->message);

            return;
        }

        $momoTransfer->update(['provider_reference' => $result->providerReference]);
    }
}
