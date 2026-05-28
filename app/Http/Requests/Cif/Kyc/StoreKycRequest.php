<?php

namespace App\Http\Requests\Cif\Kyc;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Arr;

class StoreKycRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'ghana_card_status' => [
                'required',
                'string',
            ],
            'ghana_card_number' => [
                'required',
                'string',
                // formatted as GHA-XXXXXXXX-X
                // 'regex:/^GHA-[0-9]{8}-[0-9]{3}$/',
            ],
            'region' => [
                'required',
                'string',
            ],
            'district' => [
                'required',
                'string',
            ],
            'town' => [
                'required',
                'string',
            ],
            'digital_address' => [
                'required',
                'string',
                // formatted as XX-XXX-XXX
                // 'regex:/^[A-Z]{2}-[0-9]{3}-[0-9]{3}$/',
            ],
            'source_of_funds' => [
                'required',
                'string',
            ],
            'employment_status' => [
                'required',
                'string',
            ],
            'occupation' => [
                'required',
                'string',
            ],
            'employer_name' => [
                'nullable',
                'string',
            ],
            'monthly_income' => [
                'nullable',
                'numeric',
            ],
            'ghana_card_photo' => [
                'required',
                'image',
                'max:2048',
                'mimes:png,jpg',
                'mimetypes:image/png,image/jpeg',
            ],
            'passport_photo' => [
                'required',
                'image',
                'max:2048',
                'mimes:png,jpg',
                'mimetypes:image/png,image/jpeg',
            ],
        ];
    }

    // Upload images to storage and generate paths after validation
    protected function passedValidation(): void
    {
        // Handle the ghana card photo
        if ($this->hasFile('ghana_card_photo')) {
            $this->ghana_card_photo_path = $this->file('ghana_card_photo')->store('ghana_card_photos', 'public');
        }

        // Handle the passport photo
        if ($this->hasFile('passport_photo')) {
            $this->passport_photo_path = $this->file('passport_photo')->store('passport_photos', 'public');
        }
    }

    public function validatedKycData($key = null, $default=null): array
    {
        $validated = parent::validated();

        Arr::forget($validated, ['ghana_card_photo', 'passport_photo']);

        return array_merge($validated, [
            'ghana_card_photo_path' => $this->ghana_card_photo_path,
            'passport_photo_path' => $this->passport_photo_path
        ]);
    }

}
