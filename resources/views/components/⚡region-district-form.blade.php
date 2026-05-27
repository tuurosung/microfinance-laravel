<?php

use App\Services\Kyc\RegionService;
use Livewire\Component;

new class extends Component {
    public string $selectedRegion = '';
    public string $selectedDistrict = '';
    public array $districts = [];

    public function updatedSelectedRegion(string $value): void
    {
        $this->districts = app(RegionService::class)->getDistricts($value);
        $this->selectedDistrict = '';
    }

    public function with(): array
    {
        return [
            'regions' => app(RegionService::class)->getRegions(),
        ];
    }
};
?>
<div class="grid grid-cols-12 gap-6">
    <div class="lg:col-span-3 md:col-span-3 sm:col-span-12 col-span-12">
        <x-custom.form-inputs.select name="region" id="region" label="Region" wire:model.live="selectedRegion"
            :options="$regions" required />
    </div>

    <div class="col-span-3">
        <x-custom.form-inputs.select name="district" id="district" label="District" :options="$districts"
            wire:model="selectedDistrict" required />
    </div>
    <div class="lg:col-span-3 md:col-span-3 sm:col-span-12 col-span-12">
        <x-custom.form-inputs.text-input name="town" label="Town" placeholder="Tamale" required />
    </div>
    <div class="lg:col-span-3 md:col-span-3 sm:col-span-12 col-span-12">
        <x-custom.form-inputs.text-input name="digital_address" id="digital_address" label="Digital Address (GPS)"
            placeholder="NT-xxx-xxxx" required />
    </div>
</div>
