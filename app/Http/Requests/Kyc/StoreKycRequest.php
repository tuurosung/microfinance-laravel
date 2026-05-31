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
                'regex: /^[A-Z]{2}-\d{3}-\d{4}$/',
            ],
        ];
    }

}
