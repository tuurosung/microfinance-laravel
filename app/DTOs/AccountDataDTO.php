<?php

namespace App\DTOs;

use App\Enums\Accounts\AccountMandateEnum;
use App\Enums\Accounts\AccountTypeEnum;

final readonly class AccountDataDTO
{
    /**
     * @param AccountDataDTO[] $data
     */
    public function __construct(
        public string                   $account_opening_session,
        public AccountTypeEnum     $account_type,
        public AccountMandateEnum $mandate_type,
        public float                    $min_balance,
        public float                    $opening_balance,
    ) {}


    public static function fromArray(array $data): self
    {
        return new self(
            account_opening_session: $data['account_opening_session'],

            account_type: $data['account_type'] instanceof AccountTypeEnum
                ? $data['account_type']
                : AccountTypeEnum::from($data['account_type']),

            mandate_type: $data['mandate_type'] instanceof AccountMandateEnum
                ? $data['mandate_type']
                : AccountMandateEnum::from($data['mandate_type']),
                
            min_balance: (float) $data['min_balance'],
            opening_balance: (float) $data['opening_balance'],
        );
    }

    public function toArray(): array
    {
        return [
            'account_opening_session' => $this->account_opening_session,
            'account_type' => $this->account_type,
            'mandate_type' => $this->mandate_type,
            'min_balance' => $this->min_balance,
            'opening_balance' => $this->opening_balance,
        ];
    }
}
