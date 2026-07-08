<?php

namespace App\Rules\Cifs;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Carbon;
use Illuminate\Translation\PotentiallyTranslatedString;

final class EnforceAgeRegulation implements ValidationRule
{

    private const MINIMUM_AGE = 18;
    private const MAXIMUM_PLAUSIBLE_AGE = 100;


    /**
     * Run the validation rule.
     *
     * @param  Closure(string, ?string=): PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {

        try {
            $dateOfBirth = Carbon::parse($value);
        } catch (\Exception $e) {
            $fail("The :attribute must be a valid date");
            return;
        }


        if ($dateOfBirth->isFuture()) {
            $fail('The :attribute cannot be in the future.');
            return;
        }


        $age = $dateOfBirth->diffInYears(Carbon::now());


        if ($age < self::MINIMUM_AGE) {
            $fail('Customer must be at least ' . self::MINIMUM_AGE . ' years old to open an account.');
            return;
        }


        if ($age > self::MAXIMUM_PLAUSIBLE_AGE) {
            $fail('The :attribute does not appear to be a valid date of birth.');
        }
    }
}
