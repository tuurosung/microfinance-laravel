<?php

namespace App\Http\Requests\Cif\Kyc;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

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
            // 'ghana_card_photo' => [
            //     'required',
            //     'image',
            //     'max:2048',
            // ],
            // 'digital_address_photo' => [
            //     'required',
            //     'image',
            //     'max:2048',
            // ],
        ];
    }
}
