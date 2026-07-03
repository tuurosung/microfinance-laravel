<?php

namespace App\DTOs\Transactions;

use App\Enums\Transactions\MomoProviderEnum;
use App\Enums\Transactions\TransactionChannelEnum;
use Carbon\CarbonImmutable;

final readonly class DepositData
{
    public function __construct(
        public int $amountPesewas,
        public string $idempotencyKey,
        public string $userId,
        public TransactionChannelEnum $transactionChannel,
        public ?string $narration = null,
        public ?CarbonImmutable $valueDate = null,
        public ?MomoProviderEnum $momoProvider = null,
        public ?string $walletNumber = null
    ){}
}
