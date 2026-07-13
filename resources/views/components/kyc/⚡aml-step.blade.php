<?php

use App\Domain\KYC\Models\Kyc;
use App\Domain\KYC\Services\KycComplianceService;
use App\DTOs\Kycs\AmlData;
use App\Enums\Kyc\EmploymentStatusEnum;
use App\Enums\Kyc\SourceOfFundsEnum;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Computed;
use Livewire\Component;

new class extends Component
{
    private const VALIDATABLE_FIELDS = [
        'source_of_funds',
        'employment_status',
        'occupation',
        'employer_name',
        'monthly_income'
    ];


    public Kyc $kyc;


    public ?SourceOfFundsEnum $source_of_funds = null;
    public ?EmploymentStatusEnum $employment_status = null;
    public ?string $occupation = '';
    public ?string $employer_name = '';
    public ?int $monthly_income = 0;


    protected KycComplianceService $kycComplianceService;

    public function boot(): void
    {

    }


    #[Computed]
    public function sourceOfFundsOptions(): array
    {
        return SourceOfFundsEnum::options();
    }


    #[Computed]
    public function employmentStatusOptions()
    {
        return EmploymentStatusEnum::options();
    }


    public function mount(Kyc $kyc): void
    {
        Log::info("Kyc", [$kyc]);
        $aml = $kyc->aml;
        $this->source_of_funds = $aml?->source_of_funds;
        $this->employment_status = $aml?->employment_status;
        $this->occupation = $aml?->occupation;
        $this->employer_name = $aml?->employer_name;
        $this->monthly_income = $aml?->monthly_income ?? 0;
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

    public function updated(string $property): void
    {
        if (in_array($property, self::VALIDATABLE_FIELDS, true)) {
            $this->validateOnly($property);
        }
    }


    public function updateKyc(KycComplianceService $kycComplianceService): void
    {
        try {

            $data = $this->validate();

            $amlData = AmlData::fromArray($data);
            $kycComplianceService->updateAml($this->kyc, $amlData);

            $this->dispatch("kyc-updated");
        } catch (ValidationException $e) {

            Log::error($e->getMessage());
            $this->dispatch('update-failed');
            throw $e;
        }
    }
};
?>

<div>
    <form method="POST" wire:submit.prevent="updateKyc">
        @csrf

        <div class="grid grid-cols-12 gap-6 mb-6">
            <div class="lg:col-span-3 md:col-span-3 sm:col-span-12 col-span-12">
                <x-custom.form-inputs.select label="Source Of Funds" name="source_of_funds" id="source_of_funds"
                    :options="$this->sourceOfFundsOptions" :selected="$this->source_of_funds" wire:model.live="source_of_funds" required />
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
