<?php

namespace App\Models\Kyc;

use App\Models\Kyc\Kyc;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class KycGhanaCard extends Model
{

    use SoftDeletes;

    protected $table = 'kyc_ghana_cards';
    protected $primaryKey = 'id';
    protected $keyType = 'integer';
    public $incrementing = true;


    protected $fillable =  [
        'card_status',
        'card_number'
    ];


    public function kyc(): BelongsTo
    {
        return $this->belongsTo(Kyc::class, 'kyc_id', 'kyc_id');
    }
}
