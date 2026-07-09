<?php

declare(strict_types= 1);

namespace App\Domain\CIFs\Contracts;

use App\DTOs\Cifs\CifData;
use Illuminate\Database\Eloquent\Collection;

interface CifServiceInterface
{
    /**
     * Create a new Cif File. Returns the Cif Id
     */
    public function createNew(CifData $cifData): string;


    /**
     * Return all customer information files as a collection
     */
    public function allCifs(): Collection;
}
