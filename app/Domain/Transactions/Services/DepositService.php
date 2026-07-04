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
            fundingAccountId: Account::cashTill()->id,
            customerAccountId: $account->account_id,
            amountPesewas: $depositData->amountPesewas
        ));

        $this->reactivateIfDormant($account, $data->actorId);
        $this->flagIfRequired($account, $depositData->amountPesewas, $depositData->actorId);

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

}
