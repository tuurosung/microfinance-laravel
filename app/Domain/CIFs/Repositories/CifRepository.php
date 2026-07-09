<?php

namespace App\Domain\CIFs\Repositories;

use App\Domain\CIFs\Contracts\CifRepositoryInterface;
use App\Domain\CIFs\Models\Cif;
use App\DTOs\Cifs\CifData;
use Illuminate\Database\Eloquent\Collection;

class CifRepository implements CifRepositoryInterface
{
    public function __construct(
        private Cif $model
    ) {}


    public function create(CifData $cifData): Cif
    {
        $cif = $this->model->create($cifData->toArray());

        if (! $cif) {
            throw new \DomainException("Unable to create new Customer File");
        }

        return $cif;
    }


    public function update(Cif $cif, CifData $cifData): bool
    {
        try {

            $cif->update($cifData->toArray());

        } catch (\Exception $e) {
            throw new \DomainException("Unable to update Customer information");
        }

        return true;
    }


    public function delete(Cif $cif): bool
    {
        try {
            $cif->delete();
        } catch (\Exception $e) {
            throw new \DomainException("Unable to delete Customer file");
        }

        return true;
    }


    public function allCifs(): Collection
    {
        return $this->model->get();
    }
}
