<?php

namespace App\Domain\CIFs\Contracts;

use App\Domain\CIFs\Models\Cif;

interface CifRepositoryInterface
{

    public function create(array $data): Cif;
    public function update(Cif $cif, array $data): bool;
    public function delete(Cif $cif): bool;
}
