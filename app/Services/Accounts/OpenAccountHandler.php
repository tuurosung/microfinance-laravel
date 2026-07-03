<?php

namespace App\Services\Accounts;

use App\DTOs\AccountDataDTO;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;

class OpenAccountHandler extends AccountSessionHandler
{

    protected const ACCOUNT_DATA_CACHE_PREFIX = 'account_creation_data';


    /**
     * Store account information against the user's active session
     * TTL is kept in sync with the session TTL, so that the data is automatically cleared when the session expires
     *
     * @throws \RuntimeException if the session key is invalid or does not exist
     */
    public function storeAccountData(string $userIdentifier, array $accountData): void
    {

        throw_unless(
            $this->hasSession($userIdentifier),
            \RuntimeException::class,
            'Invalid or expired account creation session. Please refresh the page and try again.'
        );

        $incomingData = AccountDataDTO::fromArray($accountData);
        $existing = Cache::get($this->accountDataCacheKey($userIdentifier));

        $incomingHash = hash('sha256', serialize($incomingData));
        $existingHash = hash('sha256', serialize($existing));

        // check hash values, idempotency check
        if ($existing && $incomingHash === $existingHash) {
            return;
        }

        Cache::put(
            $this->accountDataCacheKey($userIdentifier),
            AccountDataDTO::fromArray($accountData)->toArray(),
            now()->addSeconds(self::SESSION_TTL_SECONDS)
        );
    }


    public function getAccountData(string $userIdentifier): ?AccountDataDTO
    {
        $raw = Cache::get($this->accountDataCacheKey($userIdentifier));

        return $raw ? AccountDataDTO::fromArray($raw) : null;
    }


    public function accountDataCacheKey(string $userIdentifier): string
    {
        return self::ACCOUNT_DATA_CACHE_PREFIX . ':' . $userIdentifier;
    }


    public function deleteSession(string $userIdentifier): void
    {
        parent::deleteSession($userIdentifier);
        Cache::forget($this->accountDataCacheKey($userIdentifier));
    }
}
