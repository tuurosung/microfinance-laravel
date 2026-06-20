<?php

namespace App\Domain\CIFs\Repositories;

use App\Domain\CIFs\Contracts\CifRepositoryInterface;
use App\Domain\CIFs\Models\Cif;
use Override;

class CifRepository implements CifRepositoryInterface
{
    public function __construct(
        private Cif $model
    ) {}


    #[Override]
    public function create(array $data): Cif
    {
        return $this->model->create($data);
    }

    #[Override]
    public function update(Cif $cif, array $data): bool
    {
        return $cif->update($data);
    }

    #[Override]
    public function delete(Cif $cif): bool
    {
        return $cif->delete();
    }
}
