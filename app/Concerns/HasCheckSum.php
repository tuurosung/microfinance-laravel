<?php

namespace App\Concerns;

use Illuminate\Support\Facades\Log;

trait HasCheckSum
{

    protected function getName(): string
    {
        return class_basename($this);
    }

    protected function checkerId(): string
    {
        return auth()->user()->id;
    }



    public function getCheckSumPayload(): string
    {
        return json_encode(
            collect($this->checksumColumns)
                ->mapWithKeys(fn (string $col) => [ $col => $this->getAttribute($col)])
                ->all()
        );
    }

    public function persistChecksum(string $checksum): void
    {
        try {

            $this->check_sum = $checksum;
            $this->save();

            Log::channel('mycro')->info(
                "Checksum persisted successfully for {$this->getName()}",
                [$this->getKey()]
            );

        } catch (\Exception $e) {

            Log::channel('mycro')->error(
                "Unable to persist checksum for {$this->getName()}" . $e->getMessage()
            );

            throw new \Exception("Unable to persist checksum");

        }
    }
}
