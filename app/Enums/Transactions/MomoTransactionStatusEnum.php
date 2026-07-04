<?php

namespace App\Enums\Transactions;

enum MomoTransactionStatusEnum: string
{
    case Pending = 'pending';
    case Succeeded = 'succeeded';
    case Failed = 'failed';


    public function isTerminal(): bool
    {
        return $this !== self::Pending;
    }

}
