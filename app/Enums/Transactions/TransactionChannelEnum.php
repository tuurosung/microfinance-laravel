<?php

declare(strict_types = 1);

namespace App\Enums\Transactions;

enum TransactionChannelEnum: string
{
    case Counter = "counter";
    case Momo = "momo";

    public function label(): string
    {
        return match($this) {
            self::Counter => "Counter (Teller)",
            self::Momo => "Mobile Money",
        };
    }
}
