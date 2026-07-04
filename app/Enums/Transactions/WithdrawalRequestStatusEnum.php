<?php

declare(strict_types=1);

namespace App\Enums\Transactions;

enum WithdrawalRequestStatusEnum: string
{
    case PendingApproval = "pending_approval";
    case AwaitingGateway = "awaiting_gateway";
    case Posted = "posted";
    case Rejected = "rejected";
    case Failed = "failed";


    public function isTerminal(): bool
    {
        return match($this) {
            self::Posted, self::Rejected, self::Failed => true,
            default => false
        };
    }


    public function label()
    {
        return str($this->name)
            ->replace('_', ' ')
            ->title();
    }
}
