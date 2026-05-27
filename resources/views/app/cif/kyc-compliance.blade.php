<x-layouts::app>

    <div class="mx-auto max-w-7xl pb-10">

        <x-custom.headers.page-header title="KYC Compliance" currentPage="KYC Compliance">

        </x-custom.headers.page-header>

        @include('layouts.errors')


        <div class="flex mb-4">
            <a href="javascript:void(0)" class="animate-card">
                <div class="card ">
                    <div class="card-body ">
                        <div class="flex gap-5 items-center">
                            <i class="fi fi-sr-check-circle text-info  text-4xl"></i>
                            <div>
                                <h5 class="text-md text-dark dark:text-darklink font-medium font-cal-sans-regular">
                                    Registration
                                </h5>
                                <p class="text-xs mb-1">2.4GB
                                    Junk File</p>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
            <a href="javascript:void(0)" class="animate-card">
                <div class="card ">
                    <div class="card-body ">
                        <div class="flex gap-5 items-center">
                            <i class="fi fi-sr-check-circle text-info  text-4xl"></i>
                            <div>
                                <h5 class="text-md text-dark dark:text-darklink font-cal-sans-regular">
                                    Document Upload</h5>
                                <p class="text-xs mb-1">2.4GB
                                    Junk File</p>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
            <a href="javascript:void(0)" class="animate-card">
                <div class="card ">
                    <div class="card-body ">
                        <div class="flex gap-5 items-center">
                            <i class="fi fi-sr-check-circle text-info  text-4xl"></i>
                            <div>
                                <h5 class="text-md text-dark dark:text-darklink font-medium font-cal-sans-regular">
                                    Onboaring</h5>
                                <p class="text-xs mb-1">2.4GB
                                    Junk File</p>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
            <a href="javascript:void(0)" class="animate-card">
                <div class="card ">
                    <div class="card-body ">
                        <div class="flex gap-5 items-center">
                            <i class="fi fi-sr-check-circle text-info  text-4xl"></i>
                            <div>
                                <h5 class="text-md text-dark dark:text-darklink font-medium font-cal-sans-regular">
                                    Approval</h5>
                                <p class="text-xs mb-1">2.4GB
                                    Junk File</p>
                            </div>
                        </div>
                    </div>
                </div>
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
                    class="btn-md text-sm font-semibold rounded-md border-none bg-success hover:bg-primary hover:text-white cursor-pointer">
                    <i class="fi fi-rr-check me-3"></i>
                    Save Progress
                </button>

                <button type="button"
                    class="btn-md text-sm font-semibold rounded-md bg-primary  hover:bg-primary hover:text-white cursor-pointer">
                    Submit For Approval
                    <i class="fi fi-sr-arrow-right ms-3"></i>
                </button>

            </div>
        </div>
        <hr>


        <form method="POST" action="{{ route('cif.kyc.store', $cif) }}">
            @csrf

            <div class="grid grid-cols-12 gap-6 mt-5">
                <div class="lg:col-span-3 md:col-span-3 sm:col-span-12 col-span-12">

                    <div class="card">
                        <div class="card-header px-3 py-6 bg-blue-500 text-white rounded-t-xl">
                            <div
                                class="border-2 border-primary rounded-full h-[72px] w-[72px] flex justify-center items-center relative mx-auto mb-4">
                                <img src="{{ asset('user-1.jpg') }}" class="rounded-full h-[60px]" alt="user1">

                            </div>
                            <h3 class="text-white font-medium font-cal-sans-regular text-center text-lg">
                                Mathew Anderson
                            </h3>
                        </div>
                        <div class="card-body">

                            <div class="flex gap-4 mb-3">
                                <span>
                                    <i class="fi fi-rr-phone-call"></i>
                                </span>
                                <span>
                                    0213456789
                                </span>
                            </div>

                            <div class="flex gap-4 mb-3">
                                <span>
                                    <i class="fi fi-rr-marker"></i>
                                </span>
                                <span>
                                    123 Main Street, New York
                                </span>
                            </div>

                            <div class="flex gap-4 mb-3">
                                <span>
                                    <i class="fi fi-rr-newsletter-subscribe"></i>
                                </span>
                                <span>
                                    123 Main Street, New York
                                </span>
                            </div>

                        </div>
                    </div>

                    <div class="sr-only">

                        <ul class="max-w-xs flex flex-col font-inter-regular">
                            <li
                                class="inline-flex items-center gap-x-3.5 py-3 px-4 font-medium bg-white border border-gray-200 text-success-600 -mt-px first:rounded-t-lg first:mt-0 last:rounded-b-lg dark:bg-transparent dark:border-gray-700 dark:text-white font-cal-sans-regular text-lg">
                                KYC Compliance 1/3
                            </li>
                            <li class="inline-flex items-center gap-x-3.5 py-3 px-4 text-sm font-medium
                                bg-white border border-gray-200 text-success-600 -mt-px first:rounded-t-lg first:mt-0 last:rounded-b-lg dark:bg-transparent
                                dark:border-gray-700 dark:text-white">
                                <i class="fi fi-rr-check text-md leading-tight font-medium text-success"></i>
                                Ghana Card Verification
                            </li>
                            <li
                                class="inline-flex items-center gap-x-3.5 py-3 px-4 text-sm font-medium bg-white border border-gray-200 text-gray-800 -mt-px first:rounded-t-lg first:mt-0 last:rounded-b-lg dark:bg-transparent dark:border-gray-700 dark:text-white">
                                <i class="fi fi-rr-cross text-md leading-tight font-medium text-error"></i>
                                Digital Address Verification
                            </li>
                            <li
                                class="inline-flex items-center gap-x-3.5 py-3 px-4 text-sm font-medium bg-white border border-gray-200 text-gray-800 -mt-px first:rounded-t-lg first:mt-0 last:rounded-b-lg dark:bg-transparent dark:border-gray-700 dark:text-white">
                                <i class="fi fi-rr-cross text-md leading-tight font-medium text-error"></i>
                                AML Verification
                            </li>
                        </ul>

                    </div>
                </div>
                <div class="lg:col-span-9 md:col-span-9 sm:col-span-12 col-span-12">

                    <x-custom.cards.card title="Compliance Form">

                        <h4 class="text-lg mb-8 mt-10">1. Identification</h4>

                        <div class="grid grid-cols-12 gap-6 mb-5">
                            <div class="lg:col-span-3 md:col-span-3 sm:col-span-12 col-span-12">
                                <x-custom.form-inputs.select label="Ghana Card Status" name="ghana_card_status"
                                    id="ghana_card_status" :options="$ghanaCardStatus" :selected="$cif->kyc->ghana_card_status" required />
                            </div>
                            <div class="lg:col-span-3 md:col-span-6 sm:col-span-12 col-span-12">
                                <x-custom.form-inputs.text-input name="ghana_card_number" id="ghana_card_number"
                                    label="Ghana Card Number" :value="$cif->kyc->ghana_card_number" placeholder="GHA-XXXXXXXX-X" required />
                            </div>
                        </div>



                        <hr class="my-10">

                        <h4 class="text-lg mb-8">2. Address</h4>

                        <livewire:region-district-form />


                        <hr class="my-10">

                        <h4 class="text-lg mb-8">3. Source Of Wealth</h4>

                        <div class="grid grid-cols-12 gap-6 mb-6">
                            <div class="lg:col-span-3 md:col-span-3 sm:col-span-12 col-span-12">
                                <x-custom.form-inputs.select label="Source Of Funds" name="source_of_funds"
                                    id="source_of_funds" :options="$sourceOfFunds" required />
                            </div>
                            <div class="lg:col-span-3 md:col-span-3 sm:col-span-12 col-span-12">
                                <x-custom.form-inputs.select label="Employment Status" name="employment_status"
                                    id="employment_status" :options="$employmentStatus" required/>
                            </div>
                            <div class="lg:col-span-6 md:col-span-6 sm:col-span-12 col-span-12">
                                <x-custom.form-inputs.text-input name="occupation" id="occupation" label="Occupation" required />
                            </div>
                        </div>


                        <div class="grid grid-cols-12 gap-6 mb-6">
                            <div class="lg:col-span-6 md:col-span-6 sm:col-span-12 col-span-12">
                                <x-custom.form-inputs.text-input name="employer_name" id="employer_name"
                                    label="Employer Name" required />
                            </div>
                            <!-- <div class="lg:col-span-3 md:col-span-3 sm:col-span-12 col-span-12">

                        </div> -->
                            <div class="lg:col-span-3 md:col-span-3 sm:col-span-12 col-span-12">
                                <x-custom.form-inputs.number-input name="monthly_income" id="monthly_income"
                                    label="Monthly Income" required />
                            </div>
                        </div>


                        <hr class="my-10">

                        <h4 class="text-lg mb-8">4. Upload Documents</h4>

                        <div class="grid grid-cols-12 gap-6 mb-6">
                            <div class="lg:col-span-4 md:col-span-4 sm:col-span-12 col-span-12">
                                <div class="card">
                                    <div class="card-body">
                                        <i class="fi fi-sr-mode-portrait text-6xl text-info"></i>
                                        <h5 class="card-title mb-0">Passport Picture</h5>
                                        <p class="card-subtitle  mb-6">Upload passport picture.</p>
                                        <form action="">

                                            <label class="block">
                                                <span class="sr-only">Choose profile photo</span>
                                                <input id="passport_photo" type="file" class="block w-full text-sm text-gray-500
                                                                file:me-4 file:py-2 file:px-4
                                                                file:rounded-md file:border-0
                                                                file:text-sm file:font-semibold
                                                                file:bg-primary file:text-white
                                                                hover:file:bg-primaryemphasis
                                                                file:disabled:opacity-50 file:disabled:pointer-events-none
                                                                dark:file:bg-primary
                                                                dark:hover:file:bg-primary
                                                              ">
                                            </label>
                                        </form>

                                    </div>
                                </div>
                            </div>
                            <div class="lg:col-span-4 md:col-span-4 sm:col-span-12 col-span-12">
                                <div class="card">
                                    <div class="card-body">
                                        <i class="fi fi-sr-mode-landscape text-6xl text-primary"></i>
                                        <h5 class="card-title mb-0">Ghana Card</h5>
                                        <p class="card-subtitle  mb-6">Upload Ghana Card.</p>
                                        <form action="">

                                            <label class="block">
                                                <span class="sr-only">Choose profile photo</span>
                                                <input id="ghana_card_photo" type="file" class="block w-full text-sm text-gray-500
                                                                file:me-4 file:py-2 file:px-4
                                                                file:rounded-md file:border-0
                                                                file:text-sm file:font-semibold
                                                                file:bg-primary file:text-white
                                                                hover:file:bg-primaryemphasis
                                                                file:disabled:opacity-50 file:disabled:pointer-events-none
                                                                dark:file:bg-primary
                                                                dark:hover:file:bg-primary
                                                              ">
                                            </label>
                                        </form>

                                    </div>
                                </div>
                            </div>
                            <!-- <div class="lg:col-span-4 md:col-span-4 sm:col-span-12 col-span-12">
                                <div class="card">
                                    <div class="card-body">
                                        <i class="fi fi-sr-mode-portrait text-6xl"></i>
                                        <h5 class="card-title mb-0">Passport Picture</h5>
                                        <p class="card-subtitle  mb-6">Upload passport picture.</p>
                                        <form action="">

                                            <label class="block">
                                                <span class="sr-only">Choose profile photo</span>
                                                <input id="form_InputFile6" type="file" class="block w-full text-sm text-gray-500
                                                                file:me-4 file:py-2 file:px-4
                                                                file:rounded-md file:border-0
                                                                file:text-sm file:font-semibold
                                                                file:bg-primary file:text-white
                                                                hover:file:bg-primaryemphasis
                                                                file:disabled:opacity-50 file:disabled:pointer-events-none
                                                                dark:file:bg-primary
                                                                dark:hover:file:bg-primary
                                                              ">
                                            </label>
                                        </form>

                                    </div>
                                </div>
                            </div> -->


                        </div>


                        <div class="mt-8 flex justify-end">
                            <button type="button" class="btn bg-red-500 btn-danger hover:bg-red-200 text-white me-3 px-7">
                                <i class="fi fi-sr-arrow-left me-3"></i>
                                Return
                            </button>
                            <button type="submit" class="btn bg-primary hover:bg-primaryemphasis text-white px-8">
                                <i class="fi fi-rr-check me-3"></i>
                                Save
                            </button>
                        </div>


                    </x-custom.cards.card>


                </div>
            </div>

        </form>

    </div>

    <script></script>
</x-layouts::app>
