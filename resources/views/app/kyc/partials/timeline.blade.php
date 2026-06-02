<div class="flex mb-4 gap-1">
    <a href="javascript:void(0)" class="animate-card">

        <x-custom.cards.wizard-card label="Registration" description="Customer Information File Registration"
            icon="check-circle" />

    </a>
    <a href="javascript:void(0)" class="animate-card">
        <x-custom.cards.wizard-card
            label="Contact Info"
            description="KYC Information"
            color="{{ $cif->kyc ? 'primary' : 'error' }}"
            icon="{{ $cif->kyc ? 'check-circle' : 'cross-circle' }}"
            href="{{ route('cif.kyc.create', $cif) }}" />
    </a>
    <a href="javascript:void(0)" class="animate-card">
        <x-custom.cards.wizard-card
            label="AML Info"
            description="KYC Evaluation"
            color="{{ $cif->kyc->kycAml ? 'primary' : 'error' }}"
            icon="{{ $cif->kyc->kycAml ? 'check-circle' : 'cross-circle' }}"
            href="{{ route('cif.kyc.aml-step', $cif) }}" />
    </a>
    <a href="javascript:void(0)" class="animate-card">
        <x-custom.cards.wizard-card
            label="Ghana Card"
            description="Ghana Card Details"
            color="{{ $cif->kyc->ghanaCard ? 'primary' : 'error' }}"
            icon="{{ $cif->kyc->ghanaCard ? 'check-circle' : 'cross-circle' }}"
            href="{{ route('cif.kyc.ghana-card-step', $cif) }}" />
    </a>
    <a href="javascript:void(0)" class="animate-card">
        <x-custom.cards.wizard-card
            label="Documents"
            description="Final KYC Approval"
            color="{{ $cif->kyc->kycDocuments ? 'primary' : 'error' }}"
            icon="{{ $cif->kyc->kycDocuments ? 'check-circle' : 'cross-circle' }}"
            href="{{ route('cif.kyc.documents-step', $cif) }}" />
    </a>
</div>

<hr>

<div class="grid grid-cols-12 items-center align-content-center justify-center my-4 py-4">

    <div class="col-span-3">
        <h4 class="font-cal-sans-regular text-xl">KYC Compliance</h4>
        <p class="text-xs mb-1">Enhanced KYC For : Mathew Anderson</p>
    </div>

    <div class="col-span-3 border-r px-4 justify-items-end-safe grid">

        <button type="button"
            class="btn-md text-sm font-semibold rounded-md border border-transparent text-error hover:bg-lighterror hover:text-erroremphasis cursor-pointer">
            <i class="fi fi-sr-exit me-3"></i>
            Exit Without Saving
        </button>

    </div>

    <div class="px-4 col-span-6 gap-3 flex">

        <button type="button"
            class="btn-md text-sm font-semibold rounded-md border border-primary text-primary hover:bg-primary hover:text-white">
            <i class="fi fi-sr-arrow-left me-3"></i>
            Return
        </button>

        <button type="button"
            class="btn-md flex items-center gap-2 border-0  bg-success text-white rounded  px-4 cursor-pointer">
            <i class="fi fi-br-check me-3"></i>
            Save Progress
        </button>

        <livewire:kyc.submit-kyc-for-approval :cif="$cif" :kyc="$cif->kyc" />

    </div>
</div>

<hr>
