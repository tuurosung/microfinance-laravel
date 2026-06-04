<?php

namespace App\Services\Accounts;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class AccountSessionHandler
{
    public const SESSION_TTL_SECONDS = 120;
    public const SESSION_CACHE_PREFIX = 'account_creation_session';


    /**
     * Return an existing account creation session key, renewing its TTL on each call,
     * or create a new one if none exists. The session expires after 120 seconds
     * seconds of inactivity and should be deleted once the account is successfully created.
     */
    public function createSession(string $userIdentifier): string
    {
        $cacheKey = $this->sessionCacheKey($userIdentifier);
        $sessionKey = Cache::get($cacheKey);

        if ($sessionKey !== null) {
            Cache::put($cacheKey, $sessionKey, now()->addSeconds(self::SESSION_TTL_SECONDS));
            return $sessionKey;
        }

        $sessionKey = $this->generateSessionKey();
        Cache::put($cacheKey, $sessionKey, now()->addSeconds(self::SESSION_TTL_SECONDS));

        return $sessionKey;
    }


    protected function hasSession(string $userIdentifier): bool
    {
        return Cache::has($this->sessionCacheKey($userIdentifier));
    }


    public function sessionCacheKey(string $userIdentifier): string
    {
        return self::SESSION_CACHE_PREFIX . '_' . $userIdentifier;
    }

    protected function generateSessionKey(): string
    {
        return sprintf(
            '%s_%s_%s',
            self::SESSION_CACHE_PREFIX,
            now()->timestamp,
            Str::random(60)
        );
    }

    public function deleteSession(string $userIdentifier): void
    {
        Cache::forget($this->sessionCacheKey($userIdentifier));
    }
}
