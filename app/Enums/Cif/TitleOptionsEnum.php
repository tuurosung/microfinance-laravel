<?php

namespace App\Enums\Cif;

enum TitleOptionsEnum: string
{
    case MR = 'mr';
    case MRS = 'mrs';
    case MISS = 'miss';
    case MS = 'ms';
    case REV = 'rev';


    public function label(): string
    {
        return str($this->name)
            ->replace('_', '')
            ->title();
    }


    public static function options(): array
    {
        return collect(self::cases())
            ->mapWithKeys(fn ($option) => [
                $option->value => $option->label()
            ])
            ->toArray();
    }
}
