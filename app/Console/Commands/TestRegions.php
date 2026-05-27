<?php

namespace App\Console\Commands;

use App\Services\Kyc\RegionService;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

#[Signature('app:test-regions')]
#[Description('Command description')]
class TestRegions extends Command
{

    public const GET_REGIONS_API = 'https://regions-and-districts-in-ghana.onrender.com/regions';
    public const GET_DISTRICTS_BY_REGION_CODE = self::GET_REGIONS_API . '/regionCode';


    /**
     * Execute the console command.
     */
    public function handle(RegionService $regionService)
    {

        // $this->line(print_r($this->getRegions(), true));

        $regionCode = $this->ask('Enter a region code');

        $this->line(print_r($regionService->getDistricts($regionCode), true));

    }


    protected function getRegions() : array
    {
        $regionResponse = Http::get(self::GET_REGIONS_API)->json();

        $regions = collect($regionResponse['regions'])
            ->mapWithKeys(function ($region) {
                return [
                    $region['code'] => $region['label'],
                ];
            })
            ->toArray();

        return $regions;
    }


    protected function getDistricts(string $regionCode): array
    {
        $response = Http::get(self::GET_REGIONS_API . '/' . $regionCode)->json();
        $regionData = $response['regions'];
        $districts = $regionData['districts'];
        // dd($districts);
        $districts = collect($districts)
            ->mapWithKeys(function ($district) {
                return [
                    $district['code'] => $district['label'],
                ];
            })
            ->toArray();

        return $districts;
    }
}
