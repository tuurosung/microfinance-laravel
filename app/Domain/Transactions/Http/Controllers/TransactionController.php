<?php

declare(strict_types= 1);

namespace App\Domain\Transactions\Http\Controllers;

use App\Domain\Accounts\Models\Account;
use App\Domain\Transactions\Contracts\WithdrawalServiceInterface;
use App\Domain\Transactions\Http\Requests\Deposits\StoreDepositRequest;
use App\Domain\Transactions\Http\Requests\Withdrawals\StoreWithdrawalRequest;
use App\Domain\Transactions\Services\DepositService;
use App\Enums\Transactions\TransactionChannelEnum;
use App\Enums\Transactions\WithdrawalRequestStatusEnum;
use App\Http\Controllers\Controller;

class TransactionController extends Controller
{

    public function __construct(
        private readonly DepositService $depositService,
        private readonly WithdrawalServiceInterface $withdrawals
    ){}


    public function deposit(StoreDepositRequest $request, Account $account)
    {
        $data = $request->toData();

        if ($data->transactionChannel === TransactionChannelEnum::Momo) {
            $momo = $this->depositService->initiateMomoDeposit($account, $data);

            return [
                "message"=> "Momo request initiated. Ledger posts when the transaction is confirmed",
                "reference"=> $momo->reference,
                "status"=> $momo->status,
            ];
        }

        try {
            $reference = $this->depositService->counterDeposit($account, $data);
        } catch (\DomainException $e) {
            return redirect()->back()->with("error", $e->getMessage());
        }

        return redirect()->back()->with("success", "Deposit posted successfully. Reference {$reference}");
    }


    public function withdraw(StoreWithdrawalRequest $request, Account $account)
    {
        $withdrawal = $this->withdrawals->request($account, $request->toData());

        if ($withdrawal->status === WithdrawalRequestStatusEnum::Posted) {
            return redirect()->back()->with("success","Withdrawal posted successfully");
        }

        // return match ($withdrawal->status) {
        //     WithdrawalRequestStatusEnum::Posted => response()->json([
        //         'message'   => 'Withdrawal posted successfully.',
        //         'reference' => $withdrawal->ledger_reference,
        //     ], 201),

        //     WithdrawalRequestStatusEnum::PendingApproval => response()->json([
        //         'message'   => 'Withdrawal exceeds the teller limit and is pending supervisor approval. Funds are on hold.',
        //         'reference' => $withdrawal->reference,
        //     ], 202),

        //     WithdrawalRequestStatusEnum::AwaitingGateway => response()->json([
        //         'message'   => 'MoMo transfer initiated. Funds are on hold pending provider confirmation.',
        //         'reference' => $withdrawal->reference,
        //     ], 202),

        //     default => response()->json([
        //         'message'   => 'Withdrawal could not be completed.',
        //         'reference' => $withdrawal->reference,
        //         'status'    => $withdrawal->status,
        //         'reason'    => $withdrawal->rejection_reason,
        //     ], 422),
        // };
    }
}
