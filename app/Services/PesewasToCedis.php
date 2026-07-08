<?php

declare(strict_types= 1);

namespace App\Services;

final class PesewasToCedis
{
    public static function fromPesewas(int $pesewas): string
    {
        return number_format($pesewas / 100, 2);
    }

    public static function toPesewas(int $cedis): int
    {
        return (int) $cedis * 100;
    }
}
