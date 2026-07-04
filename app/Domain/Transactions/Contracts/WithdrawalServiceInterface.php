<?php

declare(strict_types=1);

namespace App\Domain\Transactions\Contracts;

use App\Domain\Accounts\Models\Account;
use App\Domain\Transactions\Models\WithdrawalRequest;
use App\DTOs\Transactions\WithdrawalData;

interface WithdrawalServiceInterface
{
    /**
     * Create a withdrawal request. Sub-threshold counter withdrawals post
     * immediately; everything else is held (lien) and routed onward.
     */
    public function request(Account $account, WithdrawalData $withdrawalData): WithdrawalRequest;
    public function approve(WithdrawalRequest $withdrawalRequest, int $userId): WithdrawalRequest;

    public function reject(WithdrawalRequest $withdrawalRequest, int $userId, string $reason): WithdrawalRequest;


    /**
     * Gateway settlement hooks — called by MomoSettlementService when the
     * provider confirms/declines a disbursement. Idempotent.
     */
    public function settleGatewaySuccess(WithdrawalRequest $withdrawalRequest): void;
    public function settleGatewayFailure(WithdrawalRequest $withdrawalRequest, string $reason): void;
}
