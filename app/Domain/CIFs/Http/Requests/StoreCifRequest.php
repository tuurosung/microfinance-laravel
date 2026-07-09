<?php

namespace App\Domain\CIFs\Http\Requests;

use App\Concerns\NormalizeInput;
use App\DTOs\Cifs\CifData;
use App\Enums\Cif\SexOptions;
use App\Rules\Cifs\EnforceAgeRegulation;
use App\Rules\Cifs\EnsureUniqueEmail;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Override;

class StoreCifRequest extends FormRequest
{
    use NormalizeInput;

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }



    protected function prepareForValidation(): void
    {
        $this->merge([
            "first_name" => $this->normalizeName($this->first_name),
            "other_names"=> $this->normalizeName($this->other_names),
            "email"=> $this->normalizeEmail($this->email),
        ]);
    }


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'first_name' => ['required', 'string', 'max:255'],
            'other_names' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', new EnsureUniqueEmail()],
            'phone_number' => ['required', 'string', 'max:255'],
            'secondary_phone' => ['required', 'string', 'max:255'],
            'sex' => ['required', 'string', 'max:255'],
            'date_of_birth' => ['required', 'date', new EnforceAgeRegulation()],
            'residential_address' => ['required', 'string', 'max:255'],
        ];
    }


    public function toData(): CifData
    {
        return new CifData(
            firstName: (string) $this->string('first_name'),
            otherNames: (string) $this->string('other_names'),
            dateOfBirth: $this->date_of_birth,
            sex: SexOptions::from($this->string('sex')->value()),
            email: $this->filled('email') ? (string) $this->string('email') : null,
            phoneNumber: $this->string('phone_number'),
            residentialAddress: (string) $this->string('residential_address'),
        );
    }
}
