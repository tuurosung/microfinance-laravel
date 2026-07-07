<?php

namespace App\Domain\Accounts\Models;

use App\Casts\MoneyCast;
use App\Domain\Accounts\Models\ChartOfAccount;
use App\Domain\CIFs\Models\Cif;
use App\Domain\Transactions\Models\WithdrawalRequest;
use App\Enums\Accounts\AccountStatusEnum;
use App\Enums\Accounts\AccountTypeEnum;
use App\Enums\Transactions\MomoProviderEnum;
use App\Observers\Accounts\AccountObserver;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[ObservedBy([AccountObserver::class])]
#[Fillable(["account_id", "account_type", "account_number", "account_name", "cif_id", "minimum_balance_pesewas", "mandate_type", "opening_balance", "gl_account_id"])]
class Account extends Model
{

    protected $primaryKey = 'account_id';
    protected $keyType = 'string';
    public $incrementing = false;


    protected function casts(): array
    {
        return [
            "minimum_balance_pesewas"=> MoneyCast::class,
            "opening_balance" => MoneyCast::class,
            "account_type"=> AccountTypeEnum::class,
            "status"=> AccountStatusEnum::class
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



    // ── Relations ────────────────────────────────────────────────────────

    public function cif(): BelongsTo
    {
        return $this->belongsTo(Cif::class);
    }

    public function gl(): BelongsTo
    {
        return $this->belongsTo(ChartOfAccount::class, 'gl_account_id');
    }

    public function liens(): HasMany
    {
        return $this->hasMany(Lien::class);
    }

    public function withdrawalRequests(): HasMany
    {
        return $this->hasMany(WithdrawalRequest::class);
    }


    // ── System account lookups — resolved by GL code, not magic ─────────

    public static function cashTill(): self
    {
        return self::whereHas('gl', fn($q) => $q->where('code', '1110'))->firstOrFail();
    }


    public static function loanFloat(): self
    {
        return self::whereHas('gl', fn($q) => $q->where('code', '1210'))->firstOrFail();
    }


    public static function interestIncome(): self
    {
        return self::whereHas('gl', fn($q) => $q->where('code', '4100'))->firstOrFail();
    }


    public static function momoFloat(MomoProviderEnum $provider): self
    {
        return self::whereHas('gl', fn($q) => $q->where('code', $provider->floatGlCode()))->firstOrFail();
    }
}
