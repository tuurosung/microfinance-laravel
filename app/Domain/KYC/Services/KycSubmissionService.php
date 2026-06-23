<?php

namespace App\Domain\KYC\Services;

use App\Domain\CIFs\Models\Cif;
use App\Domain\KYC\Models\Kyc;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class KycSubmissionService
{
    private const DEFAULT_KYC_LEVEL = 'basic';
    private const DEFAULT_VERIFICATION_STATUS = 'submitted';

    public function __construct(
        private readonly Cif $cif,
        private readonly Kyc $kyc,
    ) {}

    public function submit(): void
    {
        $lock = $this->acquireLock();

        if (! $lock->get()) {
            throw new \RuntimeException("KYC is already being submitted for approval.");
        }

        try {
            DB::transaction(function () {
                $this->updateKycRecord();
                $this->updateGhanaCardRecords();
                $this->updateAmlRecords();
            });
        } finally {
            $lock->release();
        }
    }

    private function updateKycRecord(): void
    {
        $updated = $this->kyc->update([
            'submitted_by'        => auth()->id(),
            'submitted_at'        => now(),
            'kyc_level'           => self::DEFAULT_KYC_LEVEL,
            'verification_status' => self::DEFAULT_VERIFICATION_STATUS,
        ]);

        if (! $updated) {
            throw new \RuntimeException("Failed to update KYC record.");
        }
    }

    // TODO: implement when Ghana Card update logic is defined
    private function updateGhanaCardRecords(): void {}

    // TODO: implement when AML update logic is defined
    private function updateAmlRecords(): void {}

    private function acquireLock(): \Illuminate\Contracts\Cache\Lock
    {
        return Cache::lock("kyc_review_{$this->kyc->cif_id}", 30);
    }
}
