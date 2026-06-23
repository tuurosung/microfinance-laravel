<?php

namespace App\Domain\CIFs\Services;

use App\Domain\CIFs\Contracts\CifRepositoryInterface;
use App\Domain\CIFs\Models\Cif;
use App\Domain\KYC\Contracts\KycRepositoryInterface;

class CifService
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        private readonly CifRepositoryInterface $cifRepositoryInterface,
        private readonly KycRepositoryInterface $kycRepositoryInterface,
        private Cif $cif
    ){}


    public function createCif(array $data): Cif
    {
        $cif = $this->cifRepositoryInterface->create($data);

        if (! $cif) {
            throw new \Exception("Unable to create new cif");
        }

        // create kyc row
        // $this->kycRepositoryInterface->updateOrCreate($cif, $data);

        return $cif;
    }


    public function getCifs()
    {
        return $this->cif->all();
    }
}
