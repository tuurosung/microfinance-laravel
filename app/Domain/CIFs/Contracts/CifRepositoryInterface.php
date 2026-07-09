<?php

namespace App\Domain\CIFs\Contracts;

use App\Domain\CIFs\Models\Cif;
use App\DTOs\Cifs\CifData;
use Illuminate\Database\Eloquent\Collection;

interface CifRepositoryInterface
{
    public function create(CifData $cifData): Cif;
    public function update(Cif $cif, CifData $cifData): bool;
    public function delete(Cif $cif): bool;


    public function allCifs(): Collection;
}
