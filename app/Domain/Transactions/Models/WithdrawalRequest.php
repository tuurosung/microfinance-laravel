<?php

declare (strict_types= 1);

namespace App\Domain\Transactions\Models;

use App\Domain\Accounts\Models\Account;
use App\Enums\Transactions\MomoProviderEnum;
use App\Enums\Transactions\TransactionChannelEnum;
use App\Enums\Transactions\WithdrawalRequestStatusEnum;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class WithdrawalRequest extends Model
{
    protected $fillable = [
        "reference",
        "account_id",
        "amount_pesewas",
        "narration",
        "channel",
        "momo_provider",
        "wallet_number",
        "idempotency_key",
        "lien_id",
        "maker_id",
        "checker_id",
        "status",
        "decided_at",
        "rejection_reason",
        "ledger_reference",
    ];


    protected function casts(): array
    {
        return [
            "amount_pesewas" => "integer",
            "channel"=> TransactionChannelEnum::class,
            "momo_provider"=> MomoProviderEnum::class,
            "status"=> WithdrawalRequestStatusEnum::class,
            "decided_at" => "datetime"
        ];
    }


    public function account(): BelongsTo
    {
       return $this->belongsTo(Account::class);
    }


    // public function lien(): BelongsTo
    // {
    //     return $this->belongsTo(Lien::class);
    // }

    public function maker(): BelongsTo
    {
        return $this->belongsTo(User::class, 'maker_id');
    }

    public function checker(): BelongsTo
    {
        return $this->belongsTo(User::class, 'checker_id');
    }

    public function momoTransaction(): HasOne
    {
        return $this->hasOne(MomoTransaction::class);
    }
}
