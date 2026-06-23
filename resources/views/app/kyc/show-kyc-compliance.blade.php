@extends('layouts.app')

@section('content')

<x-custom.headers.page-header title="KYC Compliance" currentPage="KYC Compliance">

</x-custom.headers.page-header>

@include('layouts.errors')

<div class="grid grid-cols-12 gap-6">
    <div class="col-span-3">
        @include('custom.cif.profile')
    </div>
    <div class="col-span-9">
        <div class="card min-h-[500px]">
            <div class="card-body">
                <h5 class="card-title mb-0">KYC Compliance Form</h5>
                <p class="card-subtitle  mb-6">Please Fill All Relevance Fields. Fields marked <span class="text-danger">(*)</span> are required</p>
                <div class="bg-gray-200 h-[1px] mb-15"></div>
                <!-- Stepper -->
                <div data-hs-stepper>
                    <!-- Stepper Nav -->
                    <ul class="relative flex flex-row gap-x-2 mb-15">
                        <li class="flex items-center gap-x-2 shrink basis-0 flex-1 group active" data-hs-stepper-nav-item="{
                                &quot;index&quot;: 1
                            }">
                            <span class="min-w-7 min-h-7 group inline-flex items-center text-xs align-middle">
                                <span class="size-7 flex justify-center items-center flex-shrink-0 bg-gray-100 font-medium text-gray-800 rounded-full group-focus:bg-gray-200 dark:bg-gray-700 dark:text-white dark:group-focus:bg-gray-600 hs-stepper-active:bg-primary hs-stepper-active:text-white hs-stepper-success:bg-primary hs-stepper-success:text-white hs-stepper-completed:bg-success hs-stepper-completed:group-focus:bg-success">
                                    <span class="hs-stepper-success:hidden hs-stepper-completed:hidden">1</span>
                                    <i class="fi fi-rr-check text-sm leading-tight font-medium hidden hs-stepper-success:block"></i>
                                </span>
                                <span class="ms-2 text-sm font-medium text-gray-800">
                                    Contact Info
                                </span>
                            </span>
                            <div class="w-full h-px flex-1 bg-gray-200 group-last:hidden hs-stepper-success:bg-primary hs-stepper-completed:bg-success">

                            </div>
                        </li>

                        <li class="flex items-center gap-x-2 shrink basis-0 flex-1 group" data-hs-stepper-nav-item="{
                                &quot;index&quot;: 2
                            }">
                            <span class="min-w-7 min-h-7 group inline-flex items-center text-xs align-middle">
                                <span class="size-7 flex justify-center items-center flex-shrink-0 bg-gray-100 font-medium text-gray-800 rounded-full group-focus:bg-gray-200 dark:bg-gray-700 dark:text-white dark:group-focus:bg-gray-600 hs-stepper-active:bg-primary hs-stepper-active:text-white hs-stepper-success:bg-primary hs-stepper-success:text-white hs-stepper-completed:bg-success hs-stepper-completed:group-focus:bg-success">
                                    <span class="hs-stepper-success:hidden hs-stepper-completed:hidden">2</span>
                                    <i class="fi fi-rr-check text-sm leading-tight font-medium hidden hs-stepper-success:block"></i>
                                </span>
                                <span class="ms-2 text-sm font-medium text-gray-800">
                                    AML Info
                                </span>
                            </span>
                            <div class="w-full h-px flex-1 bg-gray-200 group-last:hidden hs-stepper-success:bg-primary hs-stepper-completed:bg-success"></div>
                        </li>

                        <li class="flex items-center gap-x-2 shrink basis-0 flex-1 group" data-hs-stepper-nav-item="{
                                &quot;index&quot;: 3
                                }">
                            <span class="min-w-7 min-h-7 group inline-flex items-center text-xs align-middle">
                                <span class="size-7 flex justify-center items-center flex-shrink-0 bg-gray-100 font-medium text-gray-800 rounded-full group-focus:bg-gray-200 dark:bg-gray-700 dark:text-white dark:group-focus:bg-gray-600 hs-stepper-active:bg-primary hs-stepper-active:text-white hs-stepper-success:bg-primary hs-stepper-success:text-white hs-stepper-completed:bg-success hs-stepper-completed:group-focus:bg-success">
                                    <span class="hs-stepper-success:hidden hs-stepper-completed:hidden">3</span>
                                    <i class="fi fi-rr-check text-sm leading-tight font-medium hidden hs-stepper-success:block"></i>
                                </span>
                                <span class="ms-2 text-sm font-medium text-gray-800">
                                    Ghana Card
                                </span>
                            </span>
                            <div class="w-full h-px flex-1 bg-gray-200 group-last:hidden hs-stepper-success:bg-primary hs-stepper-completed:bg-success"></div>
                        </li>
                        <li class="flex items-center gap-x-2 shrink basis-0 flex-1 group" data-hs-stepper-nav-item="{
                                &quot;index&quot;: 4
                                }">
                            <span class="min-w-7 min-h-7 group inline-flex items-center text-xs align-middle">
                                <span class="size-7 flex justify-center items-center flex-shrink-0 bg-gray-100 font-medium text-gray-800 rounded-full group-focus:bg-gray-200 dark:bg-gray-700 dark:text-white dark:group-focus:bg-gray-600 hs-stepper-active:bg-primary hs-stepper-active:text-white hs-stepper-success:bg-primary hs-stepper-success:text-white hs-stepper-completed:bg-success hs-stepper-completed:group-focus:bg-success">
                                    <span class="hs-stepper-success:hidden hs-stepper-completed:hidden">4</span>
                                    <i class="fi fi-rr-check text-sm leading-tight font-medium hidden hs-stepper-success:block"></i>
                                </span>
                                <span class="ms-2 text-sm font-medium text-gray-800">
                                    Documents
                                </span>
                            </span>
                            <div class="w-full h-px flex-1 bg-gray-200 group-last:hidden hs-stepper-success:bg-primary hs-stepper-completed:bg-success"></div>
                        </li>
                        <!-- End Item -->
                    </ul>
                    <!-- End Stepper Nav -->

                    <!-- Stepper Content -->
                    <div class="mt-5 sm:mt-8">
                        <!-- Contact Information Content -->
                        <div data-hs-stepper-content-item="{
                                &quot;index&quot;: 1
                            }" class="h-60" style="">

                            @livewire('kyc.address-step', ['cif' => $cif, 'kyc' => $kyc])

                        </div>
                        <!-- End First Contnet -->

                        <!-- First Contnet -->
                        <div data-hs-stepper-content-item="{
                                &quot;index&quot;: 2
                            }" style="display: none;" class="">
                            <div class="p-4 h-60 bg-gray-50 flex justify-center items-center border border-dashed border-gray-200 rounded-md">
                                <h3 class="text-gray-500 text-base">
                                    Second content
                                </h3>
                            </div>
                        </div>
                        <!-- End First Contnet -->

                        <!-- First Contnet -->
                        <div data-hs-stepper-content-item="{
                                &quot;index&quot;: 3
                            }" class="h-60" style="display: none;">


                            @livewire('kyc.ghana-card-step', ['cif' => $cif, 'kyc' => $kyc])

                        </div>
                        <!-- End First Contnet -->

                        <!-- Final Contnet -->
                        <div data-hs-stepper-content-item="{
                                &quot;index&quot;: 4
                            }" style="display: none;">
                            <div class="p-4 h-60 bg-gray-50 flex justify-center items-center border border-dashed border-gray-200 rounded-md">
                                <h3 class="text-gray-500 text-base">
                                    Final content
                                </h3>
                            </div>
                        </div>
                        <!-- End Final Contnet -->
                        <!-- Final Contnet -->
                        <div data-hs-stepper-content-item="{
                                &quot;isFinal&quot;: true
                            }" style="display: none;">
                            <div class="p-4 h-48 bg-gray-50 flex justify-center items-center border border-dashed border-gray-200 rounded-md">
                                <h3 class="text-gray-500 text-base">
                                    Final content
                                </h3>
                            </div>
                        </div>
                        <!-- End Final Contnet -->

                        <!-- Button Group -->
                        <div class="mt-5 flex justify-between items-center gap-x-2 relative me-auto">
                            <button type="button" class="py-2 px-3 inline-flex items-center gap-x-1 text-sm font-medium rounded-md border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none disabled" data-hs-stepper-back-btn="" disabled="disabled">
                                <i class="fi fi-rr-arrow-left me-3 text-md leading-tight font-medium"></i>
                                Back
                            </button>
                            <button type="button" class="py-2 px-3 inline-flex items-center gap-x-1 text-sm font-semibold rounded-md border border-transparent bg-primary text-white hover:bg-primaryemphasis disabled:opacity-50 disabled:pointer-events-none" data-hs-stepper-next-btn="" style="">
                                Next
                                <i class="fi fi-rr-arrow-right text-md ms-3 leading-tight font-medium"></i>
                            </button>
                            <button type="button" class="py-2 px-3 inline-flex items-center gap-x-1 text-sm font-semibold rounded-md border border-transparent bg-primary text-white hover:bg-primaryemphasis disabled:opacity-50 disabled:pointer-events-none" data-hs-stepper-finish-btn="" style="display: none;">
                                Finish
                            </button>


                            <!-- <button type="reset" class="py-2 px-3 inline-flex items-center gap-x-1 text-sm font-semibold rounded-md border border-transparent bg-primary text-white hover:bg-primaryemphasis disabled:opacity-50 disabled:pointer-events-none" data-hs-stepper-reset-btn="" style="display: none;">
                                Return to Customer File
                            </button> -->
                        </div>
                        <!-- End Button Group -->
                    </div>
                    <!-- End Stepper Content -->
                </div>
                <!-- End Stepper -->
            </div>
        </div>
    </div>
</div>

<livewire:kyc.submit-kyc-for-approval :cif="$cif" :kyc="$kyc" />
@endsection

@section('js')
<script type="text/javascript">
    const STEPPER_SELECTOR = '[data-hs-stepper]';

    /**
     * Resolve the Livewire component rendered inside a given step's content panel.
     */
    function stepComponent(stepperEl, index) {
        const content = stepperEl.querySelector(
            `[data-hs-stepper-content-item*='"index": ${index}']`
        );
        const wireId = content.querySelector('[wire\\:id]').getAttribute('wire:id');

        console.log("returning livewire id")
        return window.Livewire.find(wireId);
    }


    /**
     * Invoke saveStep() and settle based on the event the component dispatches back.
     *
     * component.call() resolves with null regardless of the PHP return value, so the
     * outcome is signalled through dispatched events. Both listeners are torn down on
     * either outcome so they never stack across steps.
     */
    function saveStep(component) {
        console.log('initiating promise')
        return new Promise((resolve, reject) => {

            const offSaved = window.Livewire.on('kyc-updated', () => {
                console.log('update');
                settle(resolve)
            });

            const offFailed = window.Livewire.on('update-failed', () => {
                console.log('failed');
                settle(reject)
            });

            console.log("Initiating settlement")

            function settle(outcome) {
                console.log('Settling')
                offSaved();
                offFailed();
                outcome();
            }

            console.log("Calling component")
            component.call('updateKyc');
        });
    }


    function initKycStepper() {
        const stepperEl = document.querySelector(STEPPER_SELECTOR)
        if (!stepperEl) return;

        const stepper = HSStepper.getInstance(STEPPER_SELECTOR)

        stepper.on('beforeNext', async (index) => {
            stepper.disableButtons();
            stepper.setProcessedNavItem(index);

            try {

                console.log("starting try block")
                await saveStep(stepComponent(stepperEl, index));

                console.log('Timing out')

                stepper.unsetProcessedNavItem(index);
                stepper.enableButtons();
                stepper.goToNext();

            } catch {

                stepper.unsetProcessedNavItem(index);
                stepper.setErrorNavItem(index);
                requestAnimationFrame(() => {
                    requestAnimationFrame(() => stepper.enableButtons());
                });
            }
        });

        stepper.on('finish', () => {
            swalConfirm(() => {
                Livewire.getByName('kyc.submit-kyc-for-approval')[0].call('submitKycFrmForApproval');
            }, "Submit KYC For Verification?", {
                confirmText: "Yes, submit form"
            });
        });
    }

    window.addEventListener('load', initKycStepper);
</script>

@endsection
