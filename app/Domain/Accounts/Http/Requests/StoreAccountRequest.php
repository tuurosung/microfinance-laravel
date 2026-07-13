<?php

namespace App\Domain\Accounts\Http\Requests;

use App\Enums\Accounts\AccountMandateEnum;
use App\Enums\Accounts\AccountTypeEnum;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class StoreAccountRequest extends FormRequest
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
            'account_type' => [
                'required',
                'string',
                'max:15',
                new Enum(AccountTypeEnum::class)
            ],
            'cif_id' => [
                'required',
                'string',
            ],
            'account_name'=> [
                'required',
                'string',
                'max:100',
            ],
            'minimum_balance_pesewas' => [
                'required',
                'numeric',
                'min:0'
            ],
            'mandate_type' => [
                'required',
                'string',
                'max:15',
                new Enum(AccountMandateEnum::class)
            ]
        ];
    }
}
