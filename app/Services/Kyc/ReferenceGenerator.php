<?php

namespace App\Services\Kyc;

use App\Models\Kyc\Kyc;

class ReferenceGenerator
{

    // generate case reference number Format  KYC-YYYYMMDD-XXXX
    public static function generateReferenceNumber()
    {
        return (new self)->generateUniqueReference();
    }


    /**
     * Prevent Collisions
     */
    protected function generateUniqueReference(): string
    {
        $reference = $this->generateReference();

        while (Kyc::where('kyc_reference', $reference)->exists()) {
            $reference = $this->generateReference();
        }

        return $reference;
    }



    protected function generateReference(): string
    {
        $suffix = str_pad($this->getKycCount() + 1, 4, '0', STR_PAD_LEFT);
        return 'KYC-' . date('Y/m/d') . '-' . $suffix;
    }


    /**
     * Return the count of kycs for the day
     */
    protected function getKycCount(): int
    {
        return Kyc::whereDate('created_at', date('Y-m-d'))->count();
    }
}
