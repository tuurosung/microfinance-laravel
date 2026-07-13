@extends('layouts.app')

@section('content')

<x-headers.page-header pageTitle="Cif#: {{ $cif->cif_number }}">

    <a href="{{ route('cif.kyc.kyc-compliance', $cif) }}">
        <button class="btn-md bg-blue-600  flex-row items-center px-7">
            <i class="fi fi-rr-edit me-2"></i>
            Update KYC
        </button>
    </a>
    <form action="{{ route('cif.kyc.verify-kyc', $cif) }}" method="POST" class="inline">
        @csrf
        <button class="btn-md bg-green-600 px-7 cursor-pointer" type="submit">
            <i class="fi fi-rr-assessment me-2"></i>
            Verify Kyc
        </button>
    </form>


</x-headers.page-header>

<div class="card mb-10">
    <div class="card-body bg-blue-500 rounded-lg text-white!">

        <div class="grid grid-cols-12 gap-6">
            <div class="col-span-2">
                <div
                    class="border-2 border-primary rounded-full h-[72px] w-[72px] flex justify-center items-center relative">
                    <img src="{{ asset('user-1.jpg') }}" class="rounded-full h-[60px]" alt="user1">
                </div>
            </div>
            <div class="col-span-9 flex flex-col gap-3">
                <h5 class="text-white text-3xl font-cal-sans-regular font-normal">{{ $cif->full_name }}</h5>
                <div class="grid grid-cols-12">
                    <div class="col-span-3">
                        <p>{{ $cif->phone_number }}</p>
                    </div>
                    <div class="col-span-4">
                        <p>{{ $cif->phone_number }}</p>
                    </div>
                    <div class="col-span-4">
                        <p>{{ $cif->phone_number }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="grid grid-cols-12 gap-8">
    <div class="lg:col-span-4 md:col-span-4 sm:col-span-12 col-span-12">


        <div class="card sticky top-[70px]">
            <div class="card-body py-10">

                <button class="btn btn-primary w-full mb-8">
                    Verify
                </button>

                <ul class="max-w-xs flex flex-col">
                    <li class="inline-flex items-center gap-x-3 py-4 px-4 text-sm font-medium bg-white border border-gray-200 text-gray-800 -mt-px first:rounded-t-lg first:mt-0 last:rounded-b-lg dark:bg-transparent dark:border-gray-700 dark:text-white">
                        <a href="" class="flex inline-flex gap-2 items-center">
                            <i class="fi fi-sr-user text-primary"></i>
                            Personal Information
                        </a>
                    </li>
                    <li class="inline-flex items-center gap-x-3 py-4 px-4 text-sm font-medium bg-white border border-gray-200 text-gray-800 -mt-px first:rounded-t-lg first:mt-0 last:rounded-b-lg dark:bg-transparent dark:border-gray-700 dark:text-white">
                        <a href="" class="flex gap-2 items-center">
                            <i class="fi fi-sr-phone-rotary text-warning"></i>
                            Contaact Information
                        </a>
                    </li>
                    <li class="inline-flex items-center gap-x-3 py-4 px-4 text-sm font-medium bg-white border border-gray-200 text-gray-800 -mt-px first:rounded-t-lg first:mt-0 last:rounded-b-lg dark:bg-transparent dark:border-gray-700 dark:text-white">
                        <a href="" class="flex gap-2 items-center">
                            <i class="fi fi-sr-id-badge text-success"></i>
                            Ghana Card
                        </a>
                    </li>
                    <li class="inline-flex items-center gap-x-3 py-4 px-4 text-sm font-medium bg-white border border-gray-200 text-gray-800 -mt-px first:rounded-t-lg first:mt-0 last:rounded-b-lg dark:bg-transparent dark:border-gray-700 dark:text-white">
                        <a href="" class="flex gap-2 items-center">
                            <i class="fi fi-sr-fraud-prevention text-danger"></i>
                            AML Information
                        </a>
                    </li>
                </ul>
            </div>
        </div>


        <div class="sr-only">

            <ul class="max-w-xs flex flex-col font-inter-regular">
                <li
                    class="inline-flex items-center gap-x-3.5 py-3 px-4 font-medium bg-white border border-gray-200 text-success-600 -mt-px first:rounded-t-lg first:mt-0 last:rounded-b-lg dark:bg-transparent dark:border-gray-700 dark:text-white font-cal-sans-regular text-lg">
                    KYC Compliance 1/3
                </li>
                <li class="inline-flex items-center gap-x-3.5 py-3 px-4 text-sm font-medium
                                    bg-white border border-gray-200 text-success-600 -mt-px
                                    first:rounded-t-lg first:mt-0 last:rounded-b-lg dark:bg-transparent
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
    <div class="lg:col-span-8">

        <!-- Card -->
        <div class="card mb-2">
            <div class="card-body py-4 border-b border-gray-100">
                <div class="flex justify-between">
                    <div>
                        <h5 class="text-lg text-bodytext">Personal Information</h5>
                    </div>
                    <div>
                        <a href="#" class="text-success me-3">
                            <i class="fi fi-sr-check me-1 text-success"></i>
                            Verify
                        </a>
                        <a href="#" class="text-danger">
                            <i class="fi fi-sr-pennant me-1"></i>
                            Flag
                        </a>
                    </div>
                </div>

            </div>
            <div class="card-body">

                <div class="grid grid-cols-2 gap-6 mb-5">
                    <div class="col">
                        <x-custom.form-inputs.text-input label="Surname" name="surname" value="{{ $cif->first_name }}" disabled />
                    </div>
                    <div class="col">
                        <x-custom.form-inputs.text-input label="Othernames" name="othernames" value="{{ $cif->other_names }}" disabled />
                    </div>
                </div>


                <div class="grid grid-cols-4 gap-6 mb-5">
                    <div class="col">
                        <x-custom.form-inputs.text-input label="Date Of Birth" value="{{ $cif->date_of_birth }}" disabled />
                    </div>
                    <div class="col">
                        <x-custom.form-inputs.text-input label="Age" value="{{ $cif->age }} yrs" disabled />
                    </div>
                    <div class="col">
                        <x-custom.form-inputs.text-input label="Sex" value="{{ $cif->sex->label() }}" disabled />
                    </div>
                    <div class="col">
                        <x-custom.form-inputs.text-input label="Title" value="N/A" disabled />
                    </div>
                </div>

            </div>
        </div>

        <div class="divider h-[50px] border-l border-warning ms-5 mb-2"></div>

        <!-- Card -->
        <div class="card mb-5">
            <div class="card-body py-4 border-b border-gray-100">
                <div class="flex justify-between">
                    <div>
                        <h5 class="text-lg text-bodytext">Contact Information</h5>
                    </div>
                    <div>
                        <a href="#" class="text-success me-3">
                            <i class="fi fi-sr-check me-1 text-success"></i>
                            Verify
                        </a>
                        <a href="#" class="text-danger">
                            <i class="fi fi-sr-pennant me-1"></i>
                            Flag
                        </a>
                    </div>
                </div>

            </div>
            <div class="card-body">

                <div class="grid grid-cols-4 gap-6 mb-5">
                    <div class="col">
                        <x-custom.form-inputs.text-input label="Primary Phone" value="{{ $cif->phone_number }}" disabled />
                    </div>
                    <div class="col">
                        <x-custom.form-inputs.text-input label="Secondary Phone" value="{{ $cif->phone_number }}" disabled />
                    </div>
                    <div class="col-span-2">
                        <x-custom.form-inputs.text-input label="Email Address" value="{{ $cif->email }}" disabled />
                    </div>
                </div>


                <div class="grid grid-cols-4 gap-6 mb-5">

                    <div class="col">
                        <x-custom.form-inputs.text-input label="Region" value="{{ $kyc->region }}" disabled />
                    </div>
                    <div class="col">
                        <x-custom.form-inputs.text-input label="District" value="{{ $kyc->district }}" disabled />
                    </div>
                    <div class="col">
                        <x-custom.form-inputs.text-input label="City/Town" value="{{ $kyc->town }}" disabled />
                    </div>
                    <div class="col">
                        <x-custom.form-inputs.text-input label="Digital Address" value="{{ $kyc->digital_address }}" disabled />
                    </div>

                </div>



                <div class="grid grid-cols-1 gap-6 mb-5">
                    <div class="col">
                        <x-custom.form-inputs.text-input label="Residential Address" value="{{ $cif->residential_address }}" disabled />
                    </div>
                </div>


            </div>
        </div>

        <div class="divider h-[50px] border-l border-warning ms-5 mb-2"></div>

        <!-- Card -->
        <div class="card mb-5">
            <div class="card-body py-4 border-b border-gray-100">
                <div class="flex justify-between">
                    <div>
                        <h5 class="text-lg text-bodytext">Ghana Card Information</h5>
                    </div>
                    <div>
                        <a href="#" class="text-success me-3">
                            <i class="fi fi-sr-check me-1 text-success"></i>
                            Verify
                        </a>
                        <a href="#" class="text-danger">
                            <i class="fi fi-sr-pennant me-1"></i>
                            Flag
                        </a>
                    </div>
                </div>

            </div>
            <div class="card-body">

                <div class="grid grid-cols-2 gap-6 mb-5">
                    <div class="col">
                        <x-custom.form-inputs.text-input label="Card Status" value="{{ $kyc->ghanaCard?->card_status->label() }}" disabled />
                    </div>
                    <div class="col">
                        <x-custom.form-inputs.text-input label="Card Number" value="{{ $kyc->ghanaCard?->card_number }}" disabled />
                    </div>
                </div>

            </div>
        </div>

        <div class="divider h-[50px] border-l-2 border-primary ms-5 mb-2"></div>

        <!-- Card -->
        <div class="card mb-5">
            <div class="card-body py-4 border-b border-gray-100">
                <div class="flex justify-between">
                    <div>
                        <h5 class="text-lg text-bodytext">AML Information</h5>
                    </div>
                    <div>
                        <a href="#" class="text-success me-3">
                            <i class="fi fi-sr-check me-1 text-success"></i>
                            Verify
                        </a>
                        <a href="#" class="text-danger">
                            <i class="fi fi-sr-pennant me-1"></i>
                            Flag
                        </a>
                    </div>
                </div>

            </div>
            <div class="card-body">

                <div class="grid grid-cols-4 gap-6 mb-5">
                    <div class="col">
                        <x-custom.form-inputs.text-input label="Source Of Funds" value="{{ $kyc->kycAml?->source_of_funds->label() }}" disabled />
                    </div>
                    <div class="col">
                        <x-custom.form-inputs.text-input label="Employment Status" value="{{ $kyc->kycAml?->employment_status->label() }}" disabled />
                    </div>

                </div>

                <div class="grid grid-cols-2 gap-6 mb-5">
                    <div class="col">
                        <x-custom.form-inputs.text-input label="Employer Name" value="{{ $kyc->kycAml?->employer_name }}" disabled />
                    </div>
                    <div class="col">
                        <x-custom.form-inputs.text-input label="Monthly Income" value="{{ $kyc->kycAml?->monthly_income }}" disabled />
                    </div>
                </div>

            </div>
        </div>



    </div>
</div>
@endsection
