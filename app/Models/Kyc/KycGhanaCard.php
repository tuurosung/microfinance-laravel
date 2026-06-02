<?php

namespace App\Models\Kyc;

use App\Models\Kyc\Kyc;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class KycGhanaCard extends Model
{
    protected $table = 'kyc_ghana_cards';
    protected $primaryKey = 'id';
    protected $keyType = 'integer';
    public $incrementing = true;


    protected $fillable =  [
        'ghana_card_status',
        'ghana_card_number'
    ];


    public function kyc(): BelongsTo
    {
        return $this->belongsTo(Kyc::class, 'kyc_id', 'kyc_id');
    }
}
