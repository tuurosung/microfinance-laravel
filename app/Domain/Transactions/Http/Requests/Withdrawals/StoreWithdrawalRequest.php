<?php

declare(strict_types= 1);

namespace App\Domain\Transactions\Http\Requests\Withdrawals;

use App\Enums\Transactions\MomoProviderEnum;
use App\Enums\Transactions\TransactionChannelEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreWithdrawalRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'amount_pesewas'  => ['required', 'integer', 'min:1'],
            'idempotency_key' => ['required', 'string', 'max:100'],
            'narration'       => ['nullable', 'string', 'max:255'],
            'channel'         => ['required', Rule::enum(TransactionChannelEnum::class)],
            'momo_provider'   => ['required_if:channel,momo', 'nullable', Rule::enum(MomoProviderEnum::class)],
            'wallet_number'   => ['required_if:channel,momo', 'nullable', 'regex:/^(?:\+?233|0)\d{9}$/'],
        ];
    }
}
