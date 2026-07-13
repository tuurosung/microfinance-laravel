<?php

namespace App\Domain\Accounts\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreInitialAccountInformationRequest extends FormRequest
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
            'account_opening_session' => ['required', 'string'],
            'account_type' => ['required', 'string'],
            'min_balance' => ['required', 'numeric'],
            'mandate_type' => ['required', 'string'],
            'opening_balance' => ['required', 'numeric'],
        ];
    }
}
