<?php

namespace App\Domain\CIFs\Services;

use App\Domain\CIFs\Contracts\CifRepositoryInterface;
use App\Domain\CIFs\Models\Cif;

class CifService
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        private readonly CifRepositoryInterface $cifRepositoryInterface,
        private Cif $cif
    ){}


    public function createCif(array $data): Cif
    {
        $cif = $this->cifRepositoryInterface->create($data);

        if (! $cif) {
            throw new \Exception("Unable to create new cif");
        }

        return $cif;
    }


    public function getCifs()
    {
        return $this->cif->all();
    }
}
