<?php

namespace App\Domain\Transactions\Models;

use App\Enums\Transactions\TransactionChannelEnum;
use App\Enums\Transactions\TransactionTypeEnum;
use Illuminate\Database\Eloquent\Model;

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
}
