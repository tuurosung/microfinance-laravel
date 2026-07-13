<?php

namespace App\Observers;

use App\Domain\KYC\Models\Kyc;
use App\Domain\KYC\Services\ReferenceGenerator;

class KycObserver
{

    public function creating(Kyc $model): void
    {
        $model->kyc_reference = ReferenceGenerator::generateReferenceNumber();
    }


    /**
     * Handle the Kyc "created" event.
     */
    public function created(Kyc $kyc): void
    {
        //
    }

    /**
     * Handle the Kyc "updated" event.
     */
    public function updated(Kyc $kyc): void
    {
        //
    }

    /**
     * Handle the Kyc "deleted" event.
     */
    public function deleted(Kyc $kyc): void
    {
        //
    }

    /**
     * Handle the Kyc "restored" event.
     */
    public function restored(Kyc $kyc): void
    {
        //
    }

    /**
     * Handle the Kyc "force deleted" event.
     */
    public function forceDeleted(Kyc $kyc): void
    {
        //
    }
}
