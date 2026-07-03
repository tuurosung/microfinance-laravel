<?php

use App\Domain\CIFs\Models\Cif;
use App\Domain\KYC\Models\Kyc;
use App\Domain\KYC\Services\KycAmlService;
use App\Domain\KYC\Services\KycService;
use App\Enums\Kyc\EmploymentStatusEnum;
use App\Enums\Kyc\SourceOfFundsEnum;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Validate;
use Livewire\Component;

new class extends Component
{
    public Cif $cif;
    public Kyc $kyc;
    public ?string $source_of_funds = null;
    public ?string $employment_status = null;
    public ?string $occupation = null;
    public ?string $employer_name = null;

    protected KycAmlService $kycAmlService;

    #[Validate]
    public ?float $monthly_income = 0;

    public ?array $employmentStatusOptions = [];
    public ?array $sourceOfFundOptions = [];

    public function boot(KycAmlService $kycAmlService): void {
        $this->kycAmlService = $kycAmlService;
    }


    public function mount(Kyc $kyc): void
    {
        $this->kyc = $kyc;
        $this->source_of_funds = $kyc->kycAml?->source_of_funds ?? '';
        $this->monthly_income = $kyc->monthly_income ?? 0;
        $this->sourceOfFundOptions = SourceOfFundsEnum::options();
        $this->employmentStatusOptions = EmploymentStatusEnum::options();
    }

    protected function rules(): array
    {
        return [
            "source_of_funds" => ["required"],
            "employment_status" => ["required"],
            "occupation" => ["required"],
            "employer_name" => ["required"],
            "monthly_income" => 'required | numeric | gt:0',
        ];
    }


    public function updateKyc(): void
    {
        try {

            $data = $this->validate();
            $this->kycAmlService->updateAmlInfo($this->kyc, $data);

            $this->dispatch("kyc-updated");

        } catch (ValidationException $e) {

            Log::error($e->getMessage());
            $this->dispatch('update-failed');
            throw $e;

        }
    }

    public function updated()
    {
        $this->validate();
    }
};
?>

<div>
    <form method="POST" action="{{ route('cif.kyc.aml.store', [$cif, $kyc]) }}" wire:submit.prevent="updateKyc">
        @csrf

        <div class="grid grid-cols-12 gap-6 mb-6">
            <div class="lg:col-span-3 md:col-span-3 sm:col-span-12 col-span-12">
                <x-custom.form-inputs.select label="Source Of Funds" name="source_of_funds" id="source_of_funds"
                    :options="$this->sourceOfFundOptions" :selected="$this->source_of_funds" wire:model.live="source_of_funds" required />
                @error('source_of_funds')
                <span class="text-error">{{ $message }}</span>
                @enderror
            </div>
            <div class="lg:col-span-3 md:col-span-3 sm:col-span-12 col-span-12">
                <x-custom.form-inputs.select label="Employment Status" name="employment_status" id="employment_status"
                    :options="$this->employmentStatusOptions" :selected="$this->employment_status" wire:model.live="employment_status"
                    required />
                @error('employment_status')
                <span class="text-error">{{ $message }}</span>
                @enderror
            </div>
            <div class="lg:col-span-6 md:col-span-6 sm:col-span-12 col-span-12">
                <x-custom.form-inputs.text-input name="occupation" id="occupation" label="Occupation"
                    :value="$this->occupation" wire:model.live="occupation" required />
                @error('occupation')
                <span class="text-error">{{ $message }}</span>
                @enderror
            </div>
        </div>


        <div class="grid grid-cols-12 gap-6 mb-6">
            <div class="lg:col-span-6 md:col-span-6 sm:col-span-12 col-span-12">

                <x-custom.form-inputs.text-input label="Employer Name" name="employer_name" id="employer_name"
                    :value="$this->employer_name" placeholder="Ghana Health Service" wire:model.live="employer_name" required />

                @error('employer_name')
                <span class="text-error">{{ $message }}</span>
                @enderror
            </div>

            <div class="lg:col-span-3 md:col-span-3 sm:col-span-12 col-span-12">

                <x-custom.form-inputs.number-input label="Monthly Income" name="monthly_income" id="monthly_income"
                    :value="$this->monthly_income" placeholder="500" wire:model.live.blur="monthly_income" required />

                @error('monthly_income')
                <span class="text-error">{{ $message }}</span>
                @enderror
            </div>
        </div>

    </form>
</div>
