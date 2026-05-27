<?php

namespace App\Services\Kyc;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;

class RegionService
{
    private const API_URL = 'https://regions-and-districts-in-ghana.onrender.com/regions';
    private const DATA_PATH = 'data/regions.json';

    // instantiate the data variable
    private array $data;

    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        $this->data = $this->loadData();

    }

    public  function getRegions(): array
    {
        return $this->pluckFromCollection($this->data['regions']);
    }


    public function getDistricts(string $regionCode): array
    {
        $region = $this->findRegion($regionCode);

        return $region
            ? $this->pluckFromCollection($region['districts'])
            : [];
    }

    public function getRegionWithDistricts(string $regionCode): ?array
    {
        return $this->findRegion($regionCode);
    }


    private function findRegion(string $regionCode): array
    {
        return collect($this->data['regions'])
            ->firstWhere('code', $regionCode);
    }


    public function pluckFromCollection(array $items): array
    {
        return collect($items)
            ->pluck('label', 'code')
            ->toArray();
    }


    protected function loadData(): array
    {
        $filePath = resource_path(self::DATA_PATH);

        if (!File::exists($filePath)) {
            $this->downloadAndCache($filePath);
        }

        return json_decode(File::get($filePath), true);
    }


    protected function downloadAndCache(string $filePath): void
    {
        File::ensureDirectoryExists(dirname($filePath));

        $response = Http::get(self::API_URL)
            ->throw()
            ->json();

        File::put(
            $filePath,
            json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES)
        );
    }
}
