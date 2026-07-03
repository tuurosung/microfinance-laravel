<?php

declare(strict_types=1);

namespace App\DTOs\Accounts;

final readonly class AccountBalances
{
    public function __construct(
        public int $ledgerBalancePesewas,
        public int $availableBalancePesewas
    ){}
}
