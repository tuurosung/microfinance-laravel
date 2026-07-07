<?php

declare(strict_types= 1);

namespace App\Domain\Transactions\Models;

use App\Domain\Accounts\Models\Account;
use App\Enums\Transactions\TransactionChannelEnum;
use App\Enums\Transactions\TransactionTypeEnum;
use App\Models\User;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Table(timestamps: false)]
#[Fillable(["reference","debit_account_id", "credit_account_id", "amount_pesewas", "type", "channel", "value_date","posted_by", "idempotency_hash", "integrity_hash"])]
class Transaction extends Model
{

    protected function casts(): array
    {
        return [
            "amount_pesewas"=> "integer",
            "type"=> TransactionTypeEnum::class,
            "channel" => TransactionChannelEnum::class,
            "value_date" => 'date'
        ];
    }


    public function debitAccount(): BelongsTo
    {
        return $this->belongsTo(Account::class, 'debit_account_id', 'account_id');
    }


    public function creditAccount(): BelongsTo
    {
        return $this->belongsTo(Account::class, 'credit_account_id', 'account_id');
    }


    public function poster(): BelongsTo
    {
        return $this->belongsTo(User::class, 'posted_by');
    }


    public function reversalOf(): BelongsTo
    {
        return $this->belongsTo(self::class, 'reversal_of');
    }
}
