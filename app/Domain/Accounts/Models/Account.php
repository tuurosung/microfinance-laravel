<?php

namespace App\Domain\Accounts\Models;

use App\Casts\MoneyCast;
use App\Domain\CIFs\Models\Cif;
use App\Enums\Accounts\AccountTypeEnum;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(["account_type", "account_name", "cif_id", "minimum_balance_pesewas", "mandate_type", "opening_balance"])]
class Account extends Model
{

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function (Model $model) {
            $model->account_number = rand(1000, 9000);
            $model->opened_by = auth()->user()->id;
        });
    }

    protected function casts(): array
    {
        return [
            "minimum_balance_pesewas"=> MoneyCast::class,
            "opening_balance" => MoneyCast::class,
            "account_type"=> AccountTypeEnum::class
        ];
    }

    public function primaryCif(): BelongsTo
    {
        return $this->belongsTo(Cif::class, 'cif_id', 'cif_id');
    }


    public function accountName(): string
    {
        return $this->primaryCif->full_name;
    }
}
