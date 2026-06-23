<?php

use App\Domain\CIFs\Models\Cif;
use App\Domain\KYC\Models\Kyc;
use App\Domain\KYC\Services\KycGhanaCardService;
use App\Enums\Kyc\GhanaCardStatusEnum;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

new class extends Component {
    public Cif $cif;
    public Kyc $kyc;
    public ?string $card_status = '';
    public ?string $card_number = '';
    public ?string $date_of_birth = null;
    public ?array $cardStatusOptions = [];

    protected KycGhanaCardService $ghanaCardService;

    public function boot(KycGhanaCardService $ghanaCardService): void
    {
        $this->ghanaCardService = $ghanaCardService;
    }

    public function mount(Cif $cif, Kyc $kyc): void
    {
        $this->cardStatusOptions = GhanaCardStatusEnum::options();
        $this->card_number = $kyc->ghanaCard?->card_number ?? null;
        $this->card_status = $kyc->ghanaCard?->card_status ?? null;
    }

    protected function rules(): array
    {
        return [
            'card_status' => ['required', 'string'],
            'card_number' => ['required', 'regex: /^GHA-\d{9}-\d$/'],
            // 'date_of_birth' => ['required', 'date', 'before: -18 years'],
        ];
    }


    // Called via javascript component.call('saveStep)
    public function updateKyc(): bool
    {
        try {

            $data = $this->validate();

            $this->ghanaCardService->saveGhanaCard($this->kyc, $data);

            Log::info("updating records. Please wait");
            $this->dispatch('kyc-updated');
            return true;
        } catch (\Illuminate\Validation\ValidationException $e) {
            $this->dispatch('update-failed');
            throw $e;
        }
    }
};
?>

<div>
    <form method="POST" wire:submit.prevent="updateKyc">
        @csrf
        <h4 class="text-lg mb-8 mt-10">Ghana Card Details</h4>

        <div class="grid grid-cols-12 gap-6 mb-5">
            <div class="lg:col-span-6 md:col-span-6 sm:col-span-12 col-span-12">

                <x-custom.form-inputs.select label="Ghana Card Status" name="card_status" id="card_status"
                    wire:model="card_status" :options="$cardStatusOptions" :selected="$cif->kyc->ghanaCard?->card_status ?? ''" required />
                @error('card_status') <span class="text-error">{{ $message }}</span> @enderror

            </div>
            <div class="lg:col-span-6 md:col-span-6 sm:col-span-12 col-span-12">

                <x-custom.form-inputs.text-input label="Ghana Card Number" name="card_number" id="card_number"
                    wire:model="card_number" :value="$cif->kyc->ghanaCard->card_number ?? ''"
                    placeholder="GHA-XXXXXXXX-X" required />
                @error('card_number') <span class="text-error">{{ $message }}</span> @enderror

            </div>
        </div>
    </form>
</div>
