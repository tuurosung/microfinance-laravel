@extends('layouts.app')

@section('content')

<x-headers.page-header pageTitle="Cif#: {{ $cif->cif_number }}">

</x-headers.page-header>

<div class="grid grid-cols-12 gap-8">
    <div class="lg:col-span-3 md:col-span-3 sm:col-span-12 col-span-12">

        <div class="card sticky top-10">
            <div class="card-header px-3 py-6 bg-blue-500 text-white rounded-t-xl">
                <div
                    class="border-2 border-primary rounded-full h-[72px] w-[72px] flex justify-center items-center relative mx-auto mb-4">
                    <img src="{{ asset('user-1.jpg') }}" class="rounded-full h-[60px]" alt="user1">

                </div>
                <h3 class="text-white font-medium font-cal-sans-regular text-center text-lg">
                    {{ $cif->full_name }}
                </h3>
            </div>
            <div class="card-body">

                <div class="flex gap-4 mb-3">
                    <span>
                        <i class="fi fi-rr-phone-call"></i>
                    </span>
                    <span>
                        {{ $cif->phone_number }}
                    </span>
                </div>

                <div class="flex gap-4 mb-3">
                    <span>
                        <i class="fi fi-rr-marker"></i>
                    </span>
                    <span>
                        {{ $cif->residential_address }}
                    </span>
                </div>

                <div class="flex gap-4 mb-3">
                    <span>
                        <i class="fi fi-rr-newsletter-subscribe"></i>
                    </span>
                    <span>
                        {{ $cif->email }}
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
    <div class="lg:col-span-9">
        <div class="card">
            <div class="mb-4 border-b border-default">
                <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="default-tab"
                    data-tabs-toggle="#default-tab-content" role="tablist">
                    <li class="me-2" role="presentation">
                        <button class="inline-block p-4 border-b-2 rounded-t-base cursor-pointer" id="profile-tab"
                            data-tabs-target="#profile" type="button" role="tab" aria-controls="profile"
                            aria-selected="false">KYC Verification</button>
                    </li>
                    <li class="me-2" role="presentation">
                        <button
                            class="inline-block p-4 border-b-2 rounded-t-base hover:text-fg-brand hover:border-brand"
                            id="dashboard-tab" data-tabs-target="#dashboard" type="button" role="tab"
                            aria-controls="dashboard" aria-selected="false">Documents</button>
                    </li>
                    <li class="me-2" role="presentation">
                        <button
                            class="inline-block p-4 border-b-2 rounded-t-base hover:text-fg-brand hover:border-brand"
                            id="settings-tab" data-tabs-target="#settings" type="button" role="tab"
                            aria-controls="settings" aria-selected="false">Accounts</button>
                    </li>
                    <li role="presentation">
                        <button
                            class="inline-block p-4 border-b-2 rounded-t-base hover:text-fg-brand hover:border-brand"
                            id="contacts-tab" data-tabs-target="#contacts" type="button" role="tab"
                            aria-controls="contacts" aria-selected="false">Contact Information</button>
                    </li>
                </ul>
            </div>
            <div id="default-tab-content">
                <div class="hidden p-4 rounded-base bg-neutral-secondary-soft" id="profile" role="tabpanel"
                    aria-labelledby="profile-tab">

                    <div class="flex justify-between mb-9">
                        <div></div>
                        <div class="">
                            <a href="{{ route('cif.kyc.kyc-compliance', [$cif]) }}">
                                <button type="button" class="btn-md flex gap-1  font-medium rounded-md border border-gray-800 text-dark cursor-pointer hover:bg-dark hover:text-white">
                                    <i class="fi fi-rr-edit text-sm me-3 leading-[1.421]!"></i>
                                    Update KYC Compliance
                                </button>
                            </a>

                        </div>
                    </div>

                    @if (!$cif->kyc)
                    <div class="flex items-start sm:items-center p-4 mb-4 text-sm text-fg-danger-strong rounded-2 bg-danger-softer border border-danger-subtle"
                        role="alert">
                        <i class="fi fi-rr-triangle-warning me-1"></i>
                        <p>
                            <span class="font-medium me-2">Attention!</span> KYC Information Not Found
                            <a href="{{ route('cif.kyc.kyc-compliance', [$cif]) }}" class="underline">Click here</a> to add
                        </p>
                    </div>
                    @endif

                    <section class="mb-30">

                        <div class="flex justify-between items-center mb-5">
                            <div class="flex gap-x-3">
                                <h5 class="">Ghana Card</h5>

                            </div>

                            <div>
                                <x-custom.ui-elements.dropdown.dropdown-parent label="Actions">
                                    <x-custom.ui-elements.dropdown.dropdown-item label="Verified" />
                                    <x-custom.ui-elements.dropdown.dropdown-item label="Rejected" />
                                    <x-custom.ui-elements.dropdown.dropdown-item label="Fake / Forgery" />
                                </x-custom.ui-elements.dropdown.dropdown-parent>

                            </div>
                        </div>

                        <table class="w-full text-sm text-left rtl:text-right text-black">
                            <thead>
                                <tr class="border-y border-default">
                                    <th scope="row" class="pe-6 py-2 font-medium text-gray-900 whitespace-nowrap">
                                        Ghana Card Number
                                    </th>
                                    <th scope="row" class="px-6 py-2 font-medium text-gray-900 whitespace-nowrap">
                                        Verification Status
                                    </th>
                                    <th scope="row" class="px-6 py-2 font-medium text-gray-900 whitespace-nowrap">
                                        Date/Time
                                    </th>
                                    <th scope="row" class="px-6 py-2 font-medium text-gray-900 whitespace-nowrap text-end">
                                        Verification Officer
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="border-b border-default">
                                    <td class="pe-6 py-2">
                                        {{ $cif->kyc?->ghanaCard?->ghana_card_number }}
                                    </td>
                                    <td class="px-6 py-2">
                                        Verified
                                    </td>
                                    <td class="px-6 py-2">
                                        Time Verified
                                    </td>
                                    <td class="px-6 py-2 text-end">
                                        Verified By
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                    </section>


                    <!-- Address -->
                    <section class="mb-30">

                        <div class="flex justify-between items-center mb-5">
                            <h5 class="">Address</h5>
                            <div>
                                <x-custom.ui-elements.dropdown.dropdown-parent label="Actions">
                                    <x-custom.ui-elements.dropdown.dropdown-item label="Verified" />
                                    <x-custom.ui-elements.dropdown.dropdown-item label="Rejected" />
                                    <x-custom.ui-elements.dropdown.dropdown-item label="Fake / Forgery" />
                                </x-custom.ui-elements.dropdown.dropdown-parent>

                            </div>
                        </div>

                        <table class="w-full text-sm text-left rtl:text-right text-black">
                            <thead>
                                <tr class="border-y border-default">
                                    <th scope="row" class="pe-6 py-2 font-medium text-gray-900 whitespace-nowrap">
                                        GPS Address
                                    </th>
                                    <th scope="row" class="px-6 py-2 font-medium text-gray-900 whitespace-nowrap">
                                        Verification Status
                                    </th>
                                    <th scope="row" class="px-6 py-2 font-medium text-gray-900 whitespace-nowrap">
                                        Date/Time
                                    </th>
                                    <th scope="row" class="px-6 py-2 font-medium text-gray-900 whitespace-nowrap text-end">
                                        Verification Officer
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="border-b border-default">
                                    <td class="pe-6 py-2">
                                        {{ $cif->kyc?->digital_address }}
                                    </td>
                                    <td class="px-6 py-2">
                                        Verified
                                    </td>
                                    <td class="px-6 py-2">
                                        Time Verified
                                    </td>
                                    <td class="px-6 py-2 text-end">
                                        Verified By
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                    </section>


                    <div class="grid grid-cols-12 gap-6">
                        <div class="lg:col-span-6 md:col-span-6 sm:col-span-12 col-span-12">

                            <div class="card h-full">
                                <div class="card-body py-3 bg-gray-50 border-b text-dark">Contact / Address</div>
                                <div class="card-body">


                                    <!-- Row -->
                                    <div class="grid grid-cols-2 mb-5">
                                        <div class="col">
                                            <p class="text-sm">Region</p>
                                            <p class="text-sm">{{ $kyc->region }}</p>
                                        </div>
                                        <div class="col">
                                            <p class="text-sm">District</p>
                                            <p class="text-sm">{{ $kyc->district }}</p>
                                        </div>
                                    </div>


                                    <!-- Row -->
                                    <div class="grid grid-cols-2 mb-5">
                                        <div class="col">
                                            <p class="text-sm">Town</p>
                                            <p class="text-sm">{{ $kyc->town }}</p>
                                        </div>
                                        <div class="col">
                                            <p class="text-sm">GPS Address</p>
                                            <p class="text-sm">{{ $kyc->digital_address }}</p>
                                        </div>
                                    </div>


                                    <!-- Row -->
                                    <div class="grid grid-cols-2">
                                        <div class="col">
                                            <p class="text-sm">Monthly Income</p>
                                            <p class="text-sm">{{ $kyc->kycAml?->monthly_income }}</p>
                                        </div>
                                        <div class="col">
                                            <p class="text-sm">Employer Name</p>
                                            <p class="text-sm">{{ $kyc->kycAml?->employer_name }}</p>
                                        </div>
                                    </div>


                                    <p class="text-sm my-8">Verification Status</p>

                                </div>
                            </div>

                        </div>
                        <div class="lg:col-span-6 md:col-span-6 sm:col-span-12 col-span-12">

                            <!-- Card -->
                            <div class="card h-full">
                                <div class="card-body py-3 bg-gray-50 border-b text-dark">AML Information</div>
                                <div class="card-body">


                                    <!-- Row -->
                                    <div class="grid grid-cols-2 mb-5">
                                        <div class="col">
                                            <p class="text-sm">Source Of Funds</p>
                                            <p class="text-sm">{{ $kyc->kycAml?->source_of_funds }}</p>
                                        </div>
                                        <div class="col">
                                            <p class="text-sm">Employment Status</p>
                                        </div>
                                    </div>


                                    <!-- Row -->
                                    <div class="grid grid-cols-2 mb-5">
                                        <div class="col">
                                            <p class="text-sm">Occupation</p>
                                            <p class="text-sm">{{ $kyc->kycAml?->occupation }}</p>
                                        </div>
                                        <div class="col">
                                            <p class="text-sm">Employer Name</p>
                                            <p class="text-sm">{{ $kyc->kycAml?->employer_name }}</p>
                                        </div>
                                    </div>


                                    <!-- Row -->
                                    <div class="grid grid-cols-2">
                                        <div class="col">
                                            <p class="text-sm">Monthly Income</p>
                                            <p class="text-sm">{{ $kyc->kycAml?->monthly_income }}</p>
                                        </div>
                                        <div class="col">
                                            <p class="text-sm">Employer Name</p>
                                            <p class="text-sm">{{ $kyc->kycAml?->employer_name }}</p>
                                        </div>
                                    </div>


                                    <p class="text-sm my-8">Verification Status</p>

                                </div>
                            </div>

                        </div>
                    </div>











                </div>
                <div class="hidden p-4 rounded-base bg-neutral-secondary-soft" id="dashboard" role="tabpanel"
                    aria-labelledby="dashboard-tab">
                    <p class="text-sm text-body">This is some placeholder content the <strong
                            class="font-medium text-heading">Dashboard tab's associated content</strong>. Clicking
                        another tab will
                        toggle the visibility of this one for the next. The tab JavaScript swaps classes to control
                        the content
                        visibility and styling.</p>
                </div>
                <div class="hidden p-4 rounded-base bg-neutral-secondary-soft" id="settings" role="tabpanel"
                    aria-labelledby="settings-tab">
                    <p class="text-sm text-body">This is some placeholder content the <strong
                            class="font-medium text-heading">Settings tab's associated content</strong>. Clicking
                        another tab will
                        toggle the visibility of this one for the next. The tab JavaScript swaps classes to control
                        the content
                        visibility and styling.</p>
                </div>
                <div class="hidden p-4 rounded-base bg-neutral-secondary-soft" id="contacts" role="tabpanel"
                    aria-labelledby="contacts-tab">
                    <p class="text-sm text-body">This is some placeholder content the <strong
                            class="font-medium text-heading">Contacts tab's associated content</strong>. Clicking
                        another tab will
                        toggle the visibility of this one for the next. The tab JavaScript swaps classes to control
                        the content
                        visibility and styling.</p>
                </div>
            </div>
        </div>


    </div>
</div>
@endsection
