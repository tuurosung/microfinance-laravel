<?php

use App\Domain\CIFs\Models\Cif;
use App\Domain\KYC\Models\Kyc;
use App\Domain\KYC\Services\RegionService;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

new class extends Component
{
    public Cif $cif;
    public Kyc $kyc;
    public ?string $region = '';
    public ?string $district = '';
    public ?string $town = '';
    public ?string $digital_address = '';
    public $regions = [];
    public array $districts = [];

    protected RegionService $regionService;

    public function boot(RegionService $regionService): void
    {
        $this->regionService = $regionService;
    }


    public function mount(Cif $cif, Kyc $kyc): void
    {
        $this->cif = $cif;
        $this->region = $kyc->region;
        $this->regions = $this->regionService->getRegions();
        $this->district = $kyc->district;
        $this->town = $kyc->town;
        $this->digital_address = $kyc->digital_address;
    }


    public function updatedRegion(string $value): void
    {
        $this->districts = $this->regionService->getDistricts($value);
        $this->district = '';
    }

    protected function rules(): array
    {
        return [
            'region' => ['required'],
            'district' => ['required'],
            'town' => ['required'],
            'digital_address' => ['required'],
        ];
    }

    public function updateKyc(): void
    {
        try {

            $data = $this->validate();

            $this->kyc->updateOrCreate(
                ['kyc_id' => $this->kyc->kyc_id],
                $data
            );

            Log::info('Kyc Updated Successfully');
            $this->dispatch('kyc-updated');
        } catch (\Illuminate\Validation\ValidationException $e) {

            $this->dispatch('update-failed');
            throw $e;
        }
    }
};
?>

<div>
    <form wire:submit.prevent="updateKyc">
        <div class="grid grid-cols-12 gap-6">
            <div class="lg:col-span-6 md:col-span-6 sm:col-span-12 col-span-12">
                <x-custom.form-inputs.select
                    name="region"
                    id="region"
                    label="Region"
                    :selected="$kyc->region ?? ''"
                    wire:model.live="region"
                    :options="$regions" required />
                @error('region')
                <span class="text-error">{{ $message }}</span>
                @enderror
            </div>

            <div class="lg:col-span-6 md:col-span-6 sm:col-span-12 col-span-12">
                <x-custom.form-inputs.select
                    name="district"
                    id="district"
                    label="District"
                    :options="$districts"
                    :selected="$cif->kyc->district ?? ''"
                    wire:model="district" required />
                @error('district')
                <span class="text-error">{{ $message }}</span>
                @enderror
            </div>

            <div class="lg:col-span-6 md:col-span-6 sm:col-span-12 col-span-12">
                <x-custom.form-inputs.text-input
                    name="town"
                    id="town"
                    label="Town"
                    :value="$kyc->town ?? old('town')"
                    wire:model="town"
                    placeholder="Tamale" required />
                @error('town')
                <span class="text-error">{{ $message }}</span>
                @enderror
            </div>
            <div class="lg:col-span-6 md:col-span-6 sm:col-span-12 col-span-12">
                <x-custom.form-inputs.text-input
                    name="digital_address"
                    id="digital_address"
                    label="Digital Address (GPS)"
                    :value="$kyc->digital_address ?? ''"
                    wire:model="digital_address"
                    placeholder="NT-xxx-xxxx" required />
                @error('digital_address')
                <span class="text-error">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </form>
</div>
