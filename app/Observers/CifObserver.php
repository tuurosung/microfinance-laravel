<?php

namespace App\Observers;

use App\Domain\CIFs\Models\Cif;
use App\Domain\CIFs\Services\IdGenerator;

class CifObserver
{

    public function creating(Cif $model): void
    {
        $idGenerator = new IdGenerator();
        $model->cif_number = $idGenerator->generate();
        $model->maker_id = auth()->user()->id;

        // if official name is not provided, use first name and other names
        if (!$model->official_name) {
            $model->official_name = $model->first_name . ' ' . $model->other_names;
        }
    }

    /**
     * Handle the Cif "created" event.
     */
    public function created(Cif $cif): void
    {
        //
    }

    /**
     * Handle the Cif "updated" event.
     */
    public function updated(Cif $cif): void
    {
        //
    }

    /**
     * Handle the Cif "deleted" event.
     */
    public function deleted(Cif $cif): void
    {
        //
    }

    /**
     * Handle the Cif "restored" event.
     */
    public function restored(Cif $cif): void
    {
        //
    }

    /**
     * Handle the Cif "force deleted" event.
     */
    public function forceDeleted(Cif $cif): void
    {
        //
    }
}
