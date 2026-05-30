<?php

namespace App\Services\Kyc;

use App\Models\Cif\Cif;
use App\Models\Cif\Kyc;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class SubmitKycForApproval
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }


    // update kyc status to pending_approval, initiate atomic locks
    public function submitKYC(Kyc $kyc, Cif $cif)
    {
        $kyc->update([
            'submitted_by' => auth()->user()->id,
            'submitted_at' => now(),
            'kyc_level' => 'basic',
            'verification_status' => 'submitted',
            'kyc_tier' => 'basic'
        ]);

        $cif->update([
            'kyc_level' => 'basic',
            'kyc_tier' => 'basic'
        ]);

        return true;
    }


    protected function initiateAtomicLocks(Kyc $kyc, Cif $cif)
    {
        $lockKey = "kyc_review_" . $kyc->cif_id;
        return Cache::lock($lockKey, 30);
    }

    protected function lockCheck(object $lock)
    {
        if (!$lock->get()) {
            return response()->json([
                'message' => 'Kyc is already submitted for approval'
            ], 423); //423 Locked
        }
    }
}
