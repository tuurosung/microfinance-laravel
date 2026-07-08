<?php

declare(strict_types= 1);

namespace App\Domain\Transactions\Http\Requests\Deposits;

use App\DTOs\Transactions\DepositData;
use App\Enums\Transactions\MomoProviderEnum;
use App\Enums\Transactions\TransactionChannelEnum;
use Carbon\CarbonImmutable;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreDepositRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            "amount"=> ["required","integer", "min:1"],
            "idempotency_key"=> ["required","string","max:100"],
            "narration" => ["required","string","max:255"],
            "value_date"=> ["nullable","string","date_format:Y-m-d", "before_or_equal:today"],
            "channel"=> ["required", Rule::enum(TransactionChannelEnum::class)],
            'momo_provider'   => ['required_if:channel,momo', 'nullable', Rule::enum(MomoProviderEnum::class)],
            'wallet_number'   => ['required_if:channel,momo', 'nullable', 'regex:/^(?:\+?233|0)\d{9}$/']        ];
    }

    public function toData(): DepositData
    {
        return new DepositData(
            amountPesewas: (int) $this->integer('amount') * 100,
            idempotencyKey: (string) $this->string('idempotency_key'),
            userId: $this->user()->id,
            transactionChannel: TransactionChannelEnum::from($this->string('channel')->value()),
            narration: $this->filled('narration') ? (string) $this->string('narration') : null,
            valueDate: $this->filled('value_date') ? CarbonImmutable::parse($this->string('value_date')->value()) : null,
            momoProvider: $this->filled('momo_provider') ? MomoProviderEnum::from($this->string('momo_provider')->value()) : null,
            walletNumber: $this->filled('wallet_number') ? (string) $this->string('wallet_number') : null,
        );
    }
}
