<?php

namespace App\Domain\CIFs\Services;

use App\Domain\CIFs\Models\Cif;

class IdGenerator
{
    public function generate(): string
    {
        do {
            $cifNumber = $this->buildCifNumber();
        } while ($this->exists($cifNumber));

        return $cifNumber;
    }

    private function buildCifNumber(): string
    {
        $latest = Cif::query()->latest()->value('cif_number');
        $serial = $latest ? (int) substr($latest, 4) + 1 : 1;

        return sprintf('CIF-%08d', $serial);
    }

    private function exists(string $cifNumber): bool
    {
        return Cif::where('cif_number', $cifNumber)->exists();
    }
}
