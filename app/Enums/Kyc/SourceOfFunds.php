<?php

namespace App\Enums\Kyc;

enum SourceOfFunds: string
{
    case SALARY = 'salary';
    case BUSINESS_INCOME = 'business_income';
    case INVESTMENT = 'investment';
    case INHERITANCE = 'inheritance';
    case GIFT = 'gift';
    case PENSION = 'pension';
    case OTHER = 'other';


    public function label(): string
    {
        return str($this->name)
            ->replace('_', ' ')
            ->title();    }


    public static function options(): array
    {
        return collect(self::cases())
            ->mapWithKeys(fn ($sourceOfFunds) => [
                $sourceOfFunds->value => $sourceOfFunds->label()
            ])
            ->toArray();
    }
}
