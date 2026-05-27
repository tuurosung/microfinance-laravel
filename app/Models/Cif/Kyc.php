<?php

namespace App\Models\Cif;

use App\Services\Kyc\ReferenceGenerator;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Kyc extends Model
{
    use HasUuids;

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->kyc_reference = ReferenceGenerator::generateReferenceNumber();
        });
    }


    protected $table = 'kycs';
    protected $primaryKey = 'kyc_id';
    protected $keyType = 'uuid';
    public $incrementing = false;


    protected $fillable = [
        'kyc_id',
        'cif_id',
        'kyc_reference',

        'ghana_card_number',
        'ghana_card_status',
        'ghana_card_verified_at',
        'ghana_card_verification_response',

        'digital_address',
        'digital_address_status',
        'digital_address_verified_at',
        'digital_address_verification_response',

        'fingerprint_data',
        'facial_photo_path',
        'biometric_status',
        'biometric_captured_at',

        'id_card_front_path',
        'id_card_back_path',
        'utility_bill_path',
        'passport_photo_path',
        'signature_path',

        'business_cert_path',
        'tax_clearance_path',
        'directors_resolution_path',

        'additional_documents',
        'id_verified',
        'address_verified',
        'biometric_verified',
        'photo_verified',
        'signature_verified',
        'source_of_funds_verified',

        'risk_rating',
        'risk_factors',
        'pep_status',
        'pep_details',

        'sanctions_check_passed',
        'sanctions_checked_at',
        'sanctions_check_result',
        'adverse_media_check',
        'adverse_media_checked_at',

        'source_of_funds',
        'source_of_funds_description',
        'employer_name',
        'occupation',
        'monthly_income',

    ];
}
