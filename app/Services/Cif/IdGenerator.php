<?php

namespace App\Services\Cif;

use App\Models\Cif\Cif;

class IdGenerator
{
    /**
     * Create a new class instance.
     */
    public function generate()
    {
        do {
            $cifNumber = $this->idGenerator();
        } while ($this->isUnique($cifNumber));

        return $cifNumber;
    }

    /**
     * Generate a unique ID using CIF-padding serial number.
     */
    public function idGenerator(): string
    {
        // Get the latest id from the database
        $count = Cif::count();

        // Generate the new ID by incrementing the latest ID by 1
        $newId = $count ? $count + 1 : 1;

        return sprintf('%s-%s', 'CIF', str_pad($newId, 8, '0', STR_PAD_LEFT));
    }


    protected function isUnique(string $cifNumber)
    {
        return Cif::where('cif_number', $cifNumber)->exists();
    }
}
