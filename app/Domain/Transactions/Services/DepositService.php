<?php

namespace App\Domain\Transactions\Services;

use App\Concerns\Accounts\GuardCustomerAccounts;
use App\Domain\Accounts\Models\Account;
use App\Domain\Transactions\Contracts\DepositServiceInterface;
use App\Domain\Transactions\Contracts\GatewayManagerInterface;
use App\Domain\Transactions\Contracts\LedgerInterface;
use App\Domain\Transactions\Models\MomoTransaction;
use App\Domain\Transactions\Services\JournalEntry;
use App\DTOs\Gateway\MomoCollectionData;
use App\DTOs\Transactions\DepositData;
use App\Enums\Transactions\MomoDirectionEnum;
use App\Enums\Transactions\MomoTransactionStatusEnum;
use App\Enums\Transactions\TransactionChannelEnum;
use Illuminate\Support\Str;

final class DepositService implements DepositServiceInterface
{
    use GuardCustomerAccounts;

    public function __construct(
        private readonly LedgerInterface $ledger,
        private readonly GatewayManagerInterface $gateways
    ){}


    public function counterDeposit(Account $account, DepositData $depositData): string
    {
        $this->guardDepositable($account);

        $reference = $this->ledger->post(JournalEntry::deposit(
            fundingAccountId: Account::cashTill()->account_id,
            customerAccountId: $account->account_id,
            amountPesewas: $depositData->amountPesewas,
            narration: $depositData->narration,
            idempotencyKey: $depositData->idempotencyKey,
            userId: $depositData->userId,
            channel: TransactionChannelEnum::Counter,
            valueDate: $depositData->valueDate
        ));

        $this->reactivateIfDormant($account, $depositData->userId);
        $this->flagCtrIfRequired($account, $depositData->amountPesewas, $depositData->userId);



        return $reference;
    }


    public function initiateMomoDeposit(Account $account, DepositData $depositData): MomoTransaction
    {
        $this->guardDepositable($account);

        $momoTransaction = MomoTransaction::create([
            'reference' => (string) Str::uuid(),
            'direction' => MomoDirectionEnum::Collection,
            'provider' => $depositData->momoProvider,
            'wallet_number' => $depositData->walletNumber,
            'account_id' => $account->account_id,
            'amount_pesewas' => $depositData->amountPesewas,
            'narration' => $depositData->narration,
            'status' => MomoTransactionStatusEnum::Pending,
            'idempotency_key' => $depositData->idempotencyKey,
            'initiated_by' => $depositData->userId,
        ]);


        $result = $this->gateways->initiateMomoDeposit->for($depositData->momoProvider)->requestToPay(new MomoCollectionData(
            walletNumber: $depositData->walletNumber,
            amountPesewas: $depositData->amountPesewas,
            externalReference: $momoTransaction->reference,
            narration: $momoTransaction->narration
        ));


        $momoTransaction->update([
            'provider_reference' => $result->provider_reference,
            'status' => $result->accepted
                ? MomoTransactionStatusEnum::Pending
                : MomoTransactionStatusEnum::Failed,
            'failure_reason' => $result->accepted ? null : $result->message,
        ]);

        return $momoTransaction;
    }


    private function reactivateIfDormant(Account $account, int $userId): void
    {
        if (! $account->is_dormant && $account->status !== 'dormant') {
            return;
        }

        $account->update(['is_dormant' => false, 'status' => 'active']);

        // AuditTrail::log($account, $userId, 'ACCOUNT_REACTIVATED', 'dormant', 'active', 'Reactivated by dormant');
    }


    /**
     * Cash Transaction Report flag. Threshold per FIC directive lives in
     * config/banking.php. This flags for the compliance queue; it does not block.
     */
    private function flagCtrIfRequired(Account $account, int $amountPesewas, int $actorId): void
    {
        // TODO set AML Compliance threshold from BOG later
        return;

        // if ($amountPesewas < (int) config('banking.ctr_threshold_pesewas')) {
        //     return;
        // }

        // AuditTrail::log(
        //     $account,
        //     $actorId,
        //     'CTR_THRESHOLD_EXCEEDED',
        //     null,
        //     null,
        //     "Deposit of {$amountPesewas} pesewas meets the CTR reporting threshold."
        // );
    }

}
