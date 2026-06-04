<?php

namespace App\Concerns\System;

trait InteractWithEnums
{
    public function label(): string
    {
        return str($this->name)
            ->replace('_', ' ')
            ->title();
    }

    public static function options(): array
    {
        return collect(self::cases())
            ->mapWithKeys(fn($option) => [
                $option->value => $option->label()
            ])
            ->toArray();
    }
}
