<?php

namespace App\Domain\KYC\Models;

use App\Concerns\HasCheckSum;
use App\Domain\KYC\Models\KycAml;
use App\Domain\KYC\Models\KycDocument;
use App\Domain\KYC\Models\KycGhanaCard;
use App\Enums\Kyc\EmploymentStatusEnum;
use App\Enums\Kyc\SourceOfFundsEnum;
use App\Observers\KycObserver;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

#[ObservedBy([KycObserver::class])]
#[Fillable(["kyc_id", "cif_id", "kyc_reference", "region", "district", "town", "digital_address", "digital_address_status", "digital_address_verified_at"])]
class Kyc extends Model
{
    use HasUuids;
    use SoftDeletes;
    use HasCheckSum;


    protected $table = 'kycs';
    protected $primaryKey = 'kyc_id';
    protected $keyType = 'uuid';
    public $incrementing = false;


    protected function casts()
    {
        return [
            'source_of_funds' => SourceOfFundsEnum::class,
            'employment_status' => EmploymentStatusEnum::class
        ];
    }


    protected array $checksumColumns = [
        'kyc_reference',
        'region',
        'district',
        'town',
        'digital_address',
        'digital_address_status',
        'digital_address_verified_at',
    ];


    public function kycAml():HasOne
    {
        return $this->hasOne(KycAml::class, 'kyc_id', 'kyc_id');
    }


    public function ghanaCard(): HasOne
    {
        return $this->hasOne(KycGhanaCard::class, 'kyc_id', 'kyc_id');
    }


    public function kycDocuments(): HasMany
    {
        return $this->hasMany(KycDocument::class, 'kyc_id', 'kyc_id');
    }

    public function resolveRouteBinding($value, $field = null)
    {
        /** @var self $kyc */
        $kyc = $this->where($field ?? $this->getRouteKeyName(), $value)->firstOrFail();

        foreach (['kycAml', 'ghanaCard'] as $relation) {
            $kyc->setRelation($relation, $kyc->{$relation}()->firstOrCreate([]));
        }

        $kyc->setRelation('kycDocuments', $kyc->kycDocuments()->firstOrCreate([]));

        return $kyc;
    }
}



    // protected $fillable = [
    //     'kyc_id',
    //     'cif_id',
    //     'kyc_reference',

    //     'region',
    //     'district',
    //     'town',
    //     'digital_address',
    //     'digital_address_status',
    //     'digital_address_verified_at',

    //     // 'fingerprint_data',
    //     // 'facial_photo_path',
    //     // 'biometric_status',
    //     // 'biometric_captured_at',

    //     // 'id_card_front_path',
    //     // 'id_card_back_path',
    //     // 'utility_bill_path',
    //     // 'ghana_card_photo_path',
    //     // 'passport_photo_path',
    //     // 'signature_path',

    //     // 'business_cert_path',
    //     // 'tax_clearance_path',
    //     // 'directors_resolution_path',

    //     // 'additional_documents',
    //     // 'id_verified',
    //     // 'address_verified',
    //     // 'biometric_verified',
    //     // 'photo_verified',
    //     // 'signature_verified',
    //     // 'source_of_funds_verified',

    //     // 'risk_rating',
    //     // 'risk_factors',
    //     // 'pep_status',
    //     // 'pep_details',

    //     // 'sanctions_check_passed',
    //     // 'sanctions_checked_at',
    //     // 'sanctions_check_result',
    //     // 'adverse_media_check',
    //     // 'adverse_media_checked_at',

    //     // 'source_of_funds',
    //     // 'source_of_funds_description',
    //     // 'employer_name',
    //     // 'employment_status',
    //     // 'occupation',
    //     // 'monthly_income',

    // ];



