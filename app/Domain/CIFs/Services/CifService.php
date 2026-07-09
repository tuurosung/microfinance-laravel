<?php

namespace App\Domain\CIFs\Services;

use App\Domain\CIFs\Contracts\CifRepositoryInterface;
use App\Domain\CIFs\Contracts\CifServiceInterface;
use App\DTOs\Cifs\CifData;
use Illuminate\Database\Eloquent\Collection;

class CifService implements CifServiceInterface
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        private readonly CifRepositoryInterface $cifs,
    ){}



    public function createNew(CifData $cifData): string
    {
        $cif = $this->cifs->create($cifData);
        return $cif->cif_id;
    }


    public function allCifs(): Collection
    {
        return $this->cifs->allCifs();
    }


    public function getCifsAsArray(): array
    {
        return $this->allCifs()
            ->mapWithKeys(fn($cif) =>[ $cif->cif_id => $cif->full_name ])
            ->toArray();
    }
}
