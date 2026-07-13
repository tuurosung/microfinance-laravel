<?php

namespace App\Domain\KYC\Models;

use App\Concerns\HasCheckSum;
use App\Domain\KYC\Models\Kyc;
use App\Enums\Kyc\GhanaCardStatusEnum;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

#[Fillable(["card_status", "card_number"])]
class KycGhanaCard extends Model
{

    use SoftDeletes;
    use HasCheckSum;


    protected $table = 'kyc_ghana_cards';
    protected $primaryKey = 'id';
    protected $keyType = 'integer';
    public $incrementing = true;


    protected function casts(): array
    {
        return [
            'card_status' => GhanaCardStatusEnum::class
        ];
    }

    public function kyc(): BelongsTo
    {
        return $this->belongsTo(Kyc::class, 'kyc_id', 'kyc_id');
    }
}
