<?php

namespace App\Models\Cif;

use App\Models\Cif\Kyc;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class KycAml extends Model
{
    protected $table = 'kyc_aml';
    protected $primaryKey = 'id';
    protected $keyType = 'integer';
    public $incrementing = true;


    protected $fillable = [
        'source_of_funds',
        'employment_status',
        'occupation',
        'employer_name',
        'monthly_income',
    ];

    public function kyc(): BelongsTo
    {
        return $this->belongsTo(Kyc::class, 'kyc_id', 'kyc_id');
    }
}
