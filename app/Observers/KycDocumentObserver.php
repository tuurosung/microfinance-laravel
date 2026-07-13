<?php

namespace App\Observers;

use App\Domain\KYC\Models\KycDocument;
use Illuminate\Support\Str;

class KycDocumentObserver
{

    public function creating(KycDocument $model): void
    {
        $model->id = (string) Str::uuid();
        $model->uploaded_by = auth()->id() ?? null;
    }


    /**
     * Handle the KycDocument "created" event.
     */
    public function created(KycDocument $kycDocument): void
    {
        //
    }


    /**
     * Handle the KycDocument "updated" event.
     */
    public function updated(KycDocument $kycDocument): void
    {
        //
    }

    /**
     * Handle the KycDocument "deleted" event.
     */
    public function deleted(KycDocument $kycDocument): void
    {
        //
    }

    /**
     * Handle the KycDocument "restored" event.
     */
    public function restored(KycDocument $kycDocument): void
    {
        //
    }

    /**
     * Handle the KycDocument "force deleted" event.
     */
    public function forceDeleted(KycDocument $kycDocument): void
    {
        //
    }
}
