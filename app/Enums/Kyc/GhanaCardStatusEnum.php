<?php

namespace App\Enums\Kyc;

enum GhanaCardStatusEnum: string
{
    case NOT_PRESENT = 'not_present';
    case PRESENT = 'present';



    public function label(): string
    {
        return str($this->name)
            ->replace('_', ' ')
            ->title();
    }


    public static function options(): array
    {
        return collect(self::cases())
            ->mapWithKeys(fn ($ghanaCardStatus) => [
                $ghanaCardStatus->value => $ghanaCardStatus->label()
            ])
            ->toArray();
    }
}
