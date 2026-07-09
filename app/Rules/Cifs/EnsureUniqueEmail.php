<?php

namespace App\Rules\Cifs;

use App\Domain\CIFs\Models\Cif;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\DB;
use Illuminate\Translation\PotentiallyTranslatedString;

final class EnsureUniqueEmail implements ValidationRule
{

    public function __construct(
        private readonly ?string $ignoreId = null
    ){}

    /**
     * Run the validation rule.
     *
     * @param  Closure(string, ?string=): PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {

        if (! is_string($value) || trim($value) === '') {
            $fail('The :attribute is required');
            return;
        }

        $query = Cif::whereRaw('LOWER(email) = ?', [strtolower(trim($value))]);

        if ($this->ignoreId !== null) {
            $query->whereNot('cif_id', $this->ignoreId);
        }

        if (! $query->exists()) {
            $fail('Another Customer exists with the same email address');
        }
    }
}
