<?php

namespace App\Exceptions;

use App\Models\System\RecordLock;
use Exception;

class RecordLockedException extends Exception
{
    public RecordLock $lock;

    public function __construct(RecordLock $lock)
    {
        $this->lock = $lock;

        parent::__construct(
            "This record is currently in use by {$lock->lockedBy->name} . "
            . "Please try again later."
        );
    }
}
