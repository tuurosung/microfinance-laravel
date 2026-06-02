<?php

namespace App\Http\Requests\Kyc\GhanaCard;

use App\Enums\Kyc\GhanaCardStatusEnum;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class StoreKycGhanaCardRequest extends FormRequest
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
                new Enum(GhanaCardStatusEnum::class)
            ],

            'ghana_card_number' => [
                'required',
                'string',
                'regex:/^GHA-\d{9}-\d$/',
            ],

        ];
    }
}
