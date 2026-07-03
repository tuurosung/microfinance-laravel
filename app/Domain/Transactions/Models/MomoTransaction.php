<?php

declare(strict_types = 1);

namespace App\Domain\Transactions\Models;

use App\Domain\Accounts\Models\Account;
use App\Domain\Transactions\Models\WithdrawalRequest;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MomoTransaction extends Model
{
    protected $fillable = [
        "reference",
        "direction",
        "provider",
        "wallet_number",
        "account_id",
        "withdrawal_request_id",
        "amount_pesewas",
        "narration",
        "status",
        "provider_reference",
        "ledger_reference",
        "callback_payload",
        "failure_reason",
        "idempotency_key",
        "initiated_by",
    ];


    public function account(): BelongsTo
    {
        return $this->belongsTo(Account::class);
    }


    public function withdrawalRequest(): BelongsTo
    {
        return $this->belongsTo(WithdrawalRequest::class);
    }


    public function initiator(): BelongsTo
    {
        return $this->belongsTo(User::class, "initiated_by");
    }
}
