<?php

use App\Domain\Accounts\Models\AccountType;
use App\Domain\CIFs\Services\CifService;
use App\Enums\Accounts\AccountMandateEnum;
use App\Enums\Accounts\AccountTypeEnum;
use Livewire\Attributes\Computed;
use Livewire\Component;

new class extends Component
{
    protected CifService $cifService;

    public array $accountTypes;
    public array $mandateTypes;


    public string $cif_id = '';
    public string $account_type = '';
    public string $account_name = '';


    protected const CIF_NAMED_ACCOUNT_TYPES = [
        AccountTypeEnum::Susu->value,
        AccountTypeEnum::Savings->value,
        AccountTypeEnum::Current->value
    ];


    public function boot(CifService $cifService): void
    {
        $this->accountTypes = AccountTypeEnum::options();
        $this->mandateTypes = AccountMandateEnum::options();
        $this->cifService = $cifService;
    }


    public function createAccount(): void {}

    #[Computed]
    public function cifs()
    {
        return $this->cifService->getCifsAsArray() ?? [];
    }

    public function updatedCifId(): void
    {
        $this->syncAccountName();
    }

    public function updatedAccountType(): void
    {
        $this->syncAccountName();
    }

    public function accountNameIsFromCif(): bool
    {
        return in_array($this->account_type, self::CIF_NAMED_ACCOUNT_TYPES, true);
    }



    protected function syncAccountName(): void
    {
        if ($this->accountNameIsFromCif()) {
            $this->account_name = $this->cifs[$this->cif_id] ?? '';

            return;
        }

        $this->account_name = '';
    }
};
?>

<x-modals.modal modalId="new-account-modal" wire:ignore>
    <x-modals.modal-header modalId="new-account-modal" modalTitle="New Account" />

    <form action="{{ route('accounts.store') }}" method="POSt">
        @csrf

        <div class="p-6 overflow-y-auto">

            <div class="grid grid-cols-12 gap-6 mb-5">
                <div class="col-md-6">
                    <x-custom.form-inputs.select label="Account Type" name="account_type" :options="$accountTypes" selected="{{ old('account_type') }}" wire:model.live="account_type" required />
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <x-dropdowns.dropdown-with-search name="cif_id" label="Primary Cif" placeholder="Select Cif" :options="$this->cifs" wire:model.live="cif_id" />
                </div>
                <div class="col-md-6">
                    <x-custom.form-inputs.text-input name="account_name" id="account_name" label="Account Name" placeholder="" wire:model="account_name" value="{{ $this->account_name }}" required />
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <x-custom.form-inputs.number-input label="Min. Balance" name="minimum_balance_pesewas" value="{{ old('min_balance') ?? 0 }}" required />
                </div>
                <div class="col-md-6">
                    <x-custom.form-inputs.select label="Mandate Type" name="mandate_type" :options="$mandateTypes" selected="{{ old('mandate_type') }}" required />
                </div>
            </div>


        </div>

        <x-modals.modal-footer modalId="new-account-modal" btnLabel="Create Account" />

    </form>
</x-modals.modal>
