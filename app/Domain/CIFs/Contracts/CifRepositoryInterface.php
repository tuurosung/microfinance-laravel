<?php

namespace App\Domain\CIFs\Contracts;

use App\Domain\CIFs\Models\Cif;
use Illuminate\Database\Eloquent\Collection;

interface CifRepositoryInterface
{
    public function create(array $data): Cif;
    public function update(Cif $cif, array $data): bool;
    public function delete(Cif $cif): bool;


    public function allCifs(): Collection;
}
