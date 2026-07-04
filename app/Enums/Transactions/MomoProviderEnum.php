<?php

declare(strict_types = 1);

namespace App\Enums\Transactions;

enum MomoProviderEnum: string
{
    case Mtn = "mtn";
    case Telecel = "telecel";


    public function floatGlCode(): string
    {
        return match($this) {
            self::Mtn => '1121',
            self::Telecel => '1122',
        };
    }


    public function label(): string
    {
        return match($this) {
            self::Mtn => 'MTN Mobile Money',
            self::Telecel => 'Telecel Cash',
        };
    }
}
