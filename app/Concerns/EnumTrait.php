<?php

namespace App\Concerns;

trait EnumTrait
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
            ->mapWithKeys(fn($case) => [
            $case->value => $case->label()
            ])
            ->toArray();
    }
}
