<?php

use App\Domain\CIFs\Models\Cif;
use App\Domain\KYC\Models\Kyc;
use App\Domain\KYC\Services\KycComplianceService;
use App\Domain\KYC\Services\RegionService;
use App\DTOs\Kycs\KycData;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Computed;
use Livewire\Component;

new class extends Component
{
    public Cif $cif;
    public Kyc $kyc;


    public string $region = '';
    public string $district = '';
    public string $town = '';
    public string $digital_address = '';

    protected RegionService $regionService;
    protected KycComplianceService $kycComplianceService;

    public function boot(RegionService $regionService): void
    {
        $this->regionService = $regionService;
    }

    public function mount(Cif $cif, Kyc $kyc): void
    {
        $this->cif = $cif;
        $this->region = $kyc->region ?? '';
        $this->district = $kyc->district ?? '';
        $this->town = $kyc->town ?? '';
        $this->digital_address = $kyc->digital_address ?? '';
    }

    #[Computed]
    public function regions(): array
    {
        return $this->regionService->getRegions();
    }

    #[Computed]
    public function districts(): array
    {
        return $this->region ? $this->regionService->getDistricts($this->region) : [];
    }



    public function updatedRegion(): void
    {
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

    public function updateKyc(KycComplianceService $kycComplianceService): void
    {
        try {

            $data = $this->validate();

            $kycData = KycData::fromArray($data);
            $kycComplianceService->updateContact($this->kyc, $kycData);

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
                    :selected="$region"
                    wire:model.live="region"
                    :options="$this->regions" required />
                @error('region')
                <span class="text-error">{{ $message }}</span>
                @enderror
            </div>

            <div class="lg:col-span-6 md:col-span-6 sm:col-span-12 col-span-12">
                <x-custom.form-inputs.select
                    name="district"
                    id="district"
                    label="District"
                    :options="$this->districts"
                    :selected="$this->district"
                    wire:model.live="district" required />
                @error('district')
                <span class="text-error">{{ $message }}</span>
                @enderror
            </div>

            <div class="lg:col-span-6 md:col-span-6 sm:col-span-12 col-span-12">
                <x-custom.form-inputs.text-input
                    name="town"
                    id="town"
                    label="Town"
                    :value="$this->town"
                    wire:model.live="town"
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
                    :value="$this->digital_address"
                    wire:model.live="digital_address"
                    placeholder="NT-xxx-xxxx" required />
                @error('digital_address')
                <span class="text-error">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </form>
</div>
