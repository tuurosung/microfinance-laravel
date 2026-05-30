<x-layouts::app>

    <div class="mx-auto max-w-7xl">

        <x-custom.headers.page-header title="Cif#{{ $cif->cif_number }}" />


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
                <div class="mb-4 border-b border-default">
                    <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="default-tab"
                        data-tabs-toggle="#default-tab-content" role="tablist">
                        <li class="me-2" role="presentation">
                            <button class="inline-block p-4 border-b-2 rounded-t-base cursor-pointer" id="profile-tab"
                                data-tabs-target="#profile" type="button" role="tab" aria-controls="profile"
                                aria-selected="false">Profile</button>
                        </li>
                        <li class="me-2" role="presentation">
                            <button
                                class="inline-block p-4 border-b-2 rounded-t-base hover:text-fg-brand hover:border-brand"
                                id="dashboard-tab" data-tabs-target="#dashboard" type="button" role="tab"
                                aria-controls="dashboard" aria-selected="false">Dashboard</button>
                        </li>
                        <li class="me-2" role="presentation">
                            <button
                                class="inline-block p-4 border-b-2 rounded-t-base hover:text-fg-brand hover:border-brand"
                                id="settings-tab" data-tabs-target="#settings" type="button" role="tab"
                                aria-controls="settings" aria-selected="false">Settings</button>
                        </li>
                        <li role="presentation">
                            <button
                                class="inline-block p-4 border-b-2 rounded-t-base hover:text-fg-brand hover:border-brand"
                                id="contacts-tab" data-tabs-target="#contacts" type="button" role="tab"
                                aria-controls="contacts" aria-selected="false">Contacts</button>
                        </li>
                    </ul>
                </div>
                <div id="default-tab-content">
                    <div class="hidden p-4 rounded-base bg-neutral-secondary-soft" id="profile" role="tabpanel"
                        aria-labelledby="profile-tab">
                        <p class="text-sm text-body">This is some placeholder content the <strong
                                class="font-medium text-heading">Profile tab's associated content</strong>. Clicking
                            another tab will
                            toggle the visibility of this one for the next. The tab JavaScript swaps classes to control
                            the content
                            visibility and styling.</p>
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

</x-layouts::app>
