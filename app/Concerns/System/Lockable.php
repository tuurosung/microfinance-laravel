<?php

namespace App\Concerns\System;

use App\Exceptions\RecordLockedException;
use App\Models\System\RecordLock;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

trait Lockable
{
    public function lock(int $ttlMinutes = 15): RecordLock
    {
        return DB::transaction(function () use ($ttlMinutes) {

            // clean up expired locks
            $existing = $this->existingLock();

            if ($existing) {

                // if existing lock is expired, remove it
                if ($existing->isExpired()) {

                    $existing->delete();

                }elseif ($existing->isHeldBy(auth()->user())) {

                    // same person accessing the record, just update the ttl
                    $existing->update([
                        'expires_at' => now()->addMinutes($ttlMinutes)
                    ]);

                    return $existing;
                }

                throw new RecordLockedException($existing);
            }

            return RecordLock::create([
                'lockable_type' => static::class,
                'lockable_id' => $this->getKey(),
                'locked_by' => auth()->id(),
                'locked_at' => now(),
                'expires_at' => now()->addMinutes($ttlMinutes),
                'session_id' => session()->getId()
            ]);


        });
    }


    public function unlock(): void
    {
        RecordLock::where('lockable_type', static::class)
            ->where('lockable_id', $this->getKey())
            ->where('locked_by', auth()->id())
            ->delete();
    }

    public function activeLock(): ?RecordLock
    {
        return $this->lockQuery()
            ->where('expires_at', '>', now())
            ->with('lockedBy')
            ->first();
    }


    public function existingLock(): ?RecordLock
    {
        return $this->lockQuery()
            ->lockForUpdate()
            ->first();
    }

    protected function lockQuery(): Builder
    {
        return RecordLock::where('lockable_type', static::class)
            ->where('lockable_id', $this->getKey());
    }


    public function isLockedByOther(): bool
    {
        $lock = $this->activeLock();
        return $lock && ! $lock->isHeldBy(auth()->user());
    }
}
