<?php

use App\Models\Cif\Cif;
use App\Models\Cif\Kyc;
use App\Services\Kyc\SubmitKycForApproval;
use Livewire\Component;

new class extends Component {

    public Cif $cif;
    public Kyc $kyc;

    public function submit()
    {
        $submitKycForApproval = new SubmitKycForApproval();

        if ($submitKycForApproval->submitKYC($this->kyc, $this->cif)) {

            // $this->modal('submit-kyc')->close();
            return redirect()->route('cif.kyc.index');

        }
    }
};
?>

<div>
    <flux:modal.trigger name="submit-kyc">

        <button class="btn-md flex items-center gap-2 border-0 bg-blue-600 text-white rounded cursor-pointer align-middle">
            <i class="fi fi-br-check me-3"></i>
            Submit KYC Form
        </button>

    </flux:modal.trigger>


    <flux:modal name="submit-kyc" class="min-w-88" :dismissible="false">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Submit KYC Form?</flux:heading>
                <flux:text class="mt-2">
                    You're about to submit the KYC form.<br>
                    This action cannot be reversed.
                </flux:text>
            </div>
            <div class="flex gap-2">
                <flux:spacer />
                <flux:modal.close>
                    <flux:button variant="ghost">Cancel</flux:button>
                </flux:modal.close>
                <flux:button type="submit" variant="primary" wire:click="submit">Submit KYC Form</flux:button>
            </div>
        </div>
    </flux:modal>
</div>
