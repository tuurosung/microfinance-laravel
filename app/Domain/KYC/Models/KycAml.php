<?php

namespace App\Domain\KYC\Models;

use App\Concerns\HasCheckSum;
use App\Domain\KYC\Models\Kyc;
use App\Enums\Kyc\EmploymentStatusEnum;
use App\Enums\Kyc\SourceOfFundsEnum;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

#[Fillable(["source_of_funds", "employment_status", "occupation", "employer_name", "monthly_income"])]
class KycAml extends Model
{
    use SoftDeletes;
    use HasCheckSum;


    protected $table = 'kyc_aml';
    protected $primaryKey = 'id';
    protected $keyType = 'integer';
    public $incrementing = true;


    protected function casts(): array
    {
        return [
            'source_of_funds'=> SourceOfFundsEnum::class,
            'employment_status'=> EmploymentStatusEnum::class,
        ];
    }


    protected array $checksumColumns = [
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
