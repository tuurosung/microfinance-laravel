<?php

namespace App\Concerns;

use Illuminate\Support\Str;

trait ArrayableDTO
{
    public function toArray(): array
    {

        $data = [];

        foreach (get_object_vars($this) as $key => $value) {
            $data[Str::snake($key)] = $value;
        }

        return $data;
    }
}
