<?php

namespace App\Concerns;

trait NormalizeInput
{
    /**
     * Override in the concrete request: field name => normalizer name.
     * e.g. ['email' => 'email', 'wallet_number' => 'msisdn']
     */
    protected function normalizedFields(): array
    {
        return [];
    }


    protected function normalizeEmail(string $value): string
    {
        return strtolower(trim($value));
    }


    /**
     * Ghana msisdn: strip everything but digits and a leading +.
     */
    protected function normalizeMsisdn(string $value): string
    {
        return preg_replace('/[^\d+]/', '', $value) ?? $value;
    }


    protected function normalizeName(string $value): string
    {
        $collapsed = trim(preg_replace('/\s+/', ' ', $value) ?? $value);
        return mb_convert_case($collapsed, MB_CASE_TITLE, 'UTF-8');
    }
}
