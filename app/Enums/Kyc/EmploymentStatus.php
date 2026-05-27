<?php

namespace App\Enums\Kyc;

enum EmploymentStatus: string
{
    case EMPLOYED = 'employed';
    case UNEMPLOYED = 'unemployed';
    case RETIRED = 'retired';


    public function label(): string
    {
        return str($this->name)
            ->replace('_', ' ')
            ->title();
    }


    public static function options(): array
    {
        return collect(self::cases())
            ->mapWithKeys(fn ($employmentStatus) => [
                $employmentStatus->value => $employmentStatus->label()
            ])
            ->toArray();
    }
}
