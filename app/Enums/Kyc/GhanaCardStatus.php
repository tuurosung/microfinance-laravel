<?php

namespace App\Enums\Kyc;

enum GhanaCardStatus: string
{
    case NOT_SUBMITTED = 'not_submitted';
    case PENDING_VERIFICATION = 'pending_verification';
    case VERIFIED = 'verified';
    case FAILED = 'failed';
    case EXPIRED = 'expired';



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
