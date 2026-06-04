<?php

namespace App\Models\Kyc;

use App\Enums\Kyc\EmploymentStatusEnum;
use App\Enums\Kyc\SourceOfFundsEnum;
use App\Models\Kyc\Kyc;
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


    protected $casts = [
        'source_of_funds' => SourceOfFundsEnum::class,
        'employment_status' => EmploymentStatusEnum::class,
    ];

    public function kyc(): BelongsTo
    {
        return $this->belongsTo(Kyc::class, 'kyc_id', 'kyc_id');
    }
}
