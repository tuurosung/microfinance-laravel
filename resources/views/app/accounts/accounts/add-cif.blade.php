@extends('layouts.app')

@section('content')

<x-headers.page-header pageTitle="Add Account Cif">
    <button class="btn-md bg-blue-600 hover:bg-primary cursor-pointer">
        <i class="fi fi-br-plus me-3"></i>
        Add Cif
    </button>

    <button type="button"
        class="btn-md text-sm font-semibold rounded-md border border-transparent bg-primary text-white hover:bg-primaryemphasis disabled:opacity-50 disabled:pointer-events-none dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600"
        data-hs-overlay="#hs-slide-down-animation-modal">
        Open modal
    </button>




    <!-- Log Selected -->
    <div class="mt-5 pt-5 border-t border-gray-200">
        <div class="hs-tooltip inline-block">
            <button id="hs-log-combobox-basic-usage-current-data" type="button" class="hs-tooltip-toggle py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg bg-white border border-gray-200 text-gray-800 shadow-2xs hover:bg-gray-50 focus:outline-hidden focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none">
                Log Selected
                <span class="hs-tooltip-content hs-tooltip-shown:opacity-100 hs-tooltip-shown:visible opacity-0 transition-opacity inline-block max-w-50 absolute invisible z-10 py-1 px-2 bg-gray-900 border border-transparent text-xs font-medium text-white rounded-md shadow-2xs" role="tooltip">
                    Click and open the developer console to see the current state of the component.
                </span>
            </button>
        </div>
    </div>
    <!-- End Log Selected -->
</x-headers.page-header>


<div class="card">
    <div class="card-body">

        <!-- End Combobox -->
        <div id="hs-combobox-basic-usage" class="relative" data-hs-combo-box>
            <div class="relative">
                <input class="py-2.5 sm:py-3 ps-4 pe-9 block w-full bg-white border-gray-200 rounded-lg sm:text-sm text-gray-800 placeholder:text-gray-500 focus:border-blue-700 focus:ring-blue-700 disabled:opacity-50 disabled:pointer-events-none" type="text" role="combobox" aria-expanded="false" value="Argentina" data-hs-combo-box-input>
                <div class="absolute top-1/2 inset-e-3 -translate-y-1/2" aria-expanded="false" role="button" data-hs-combo-box-toggle>
                    <svg class="shrink-0 size-3.5 text-gray-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="m7 15 5 5 5-5"></path>
                        <path d="m7 9 5-5 5 5"></path>
                    </svg>
                </div>
            </div>
            <div class="absolute z-50 w-full max-h-72 p-1 bg-white border border-transparent rounded-lg shadow-xl overflow-hidden overflow-y-auto [&::-webkit-scrollbar]:w-2 [&::-webkit-scrollbar-thumb]:rounded-none [&::-webkit-scrollbar-track]:bg-gray-100 [&::-webkit-scrollbar-thumb]:bg-gray-300" style="display: none;" role="listbox" data-hs-combo-box-output>
                <div class="cursor-pointer py-2 px-4 w-full text-sm text-gray-800 hover:bg-gray-100 rounded-lg focus:outline-hidden focus:bg-gray-100" role="option" tabindex="0" data-hs-combo-box-output-item data-hs-combo-box-item-stored-data='{
      "id": 1,
      "name": "Argentina"
    }'>
                    <div class="flex justify-between items-center w-full">
                        <span data-hs-combo-box-search-text="Argentina" data-hs-combo-box-value>Argentina</span>
                        <span class="hidden hs-combo-box-selected:block">
                            <svg class="shrink-0 size-3.5 text-gray-800" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M20 6 9 17l-5-5" />
                            </svg>
                        </span>
                    </div>
                </div>
                <div class="cursor-pointer py-2 px-4 w-full text-sm text-gray-800 hover:bg-gray-100 rounded-lg focus:outline-hidden focus:bg-gray-100" role="option" tabindex="1" data-hs-combo-box-output-item data-hs-combo-box-item-stored-data='{
      "id": 2,
      "name": "Brazil"
    }'>
                    <div class="flex justify-between items-center w-full">
                        <span data-hs-combo-box-search-text="Brazil" data-hs-combo-box-value>Brazil</span>
                        <span class="hidden hs-combo-box-selected:block">
                            <svg class="shrink-0 size-3.5 text-gray-800" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M20 6 9 17l-5-5" />
                            </svg>
                        </span>
                    </div>
                </div>
                <div class="cursor-pointer py-2 px-4 w-full text-sm text-gray-800 hover:bg-gray-100 rounded-lg focus:outline-hidden focus:bg-gray-100" role="option" tabindex="2" data-hs-combo-box-output-item data-hs-combo-box-item-stored-data='{
      "id": 3,
      "name": "China"
    }'>
                    <div class="flex justify-between items-center w-full">
                        <span data-hs-combo-box-search-text="China" data-hs-combo-box-value>China</span>
                        <span class="hidden hs-combo-box-selected:block">
                            <svg class="shrink-0 size-3.5 text-gray-800" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M20 6 9 17l-5-5" />
                            </svg>
                        </span>
                    </div>
                </div>


                <div class="cursor-pointer py-2 px-4 w-full text-sm text-gray-800 hover:bg-gray-100 rounded-lg focus:outline-hidden focus:bg-gray-100" role="option" tabindex="3" data-hs-combo-box-output-item data-hs-combo-box-item-stored-data='{
      "id": 6,
      "name": "France"
    }'>
                    <div class="flex justify-between items-center w-full">
                        <span data-hs-combo-box-search-text="France" data-hs-combo-box-value>France</span>
                        <span class="hidden hs-combo-box-selected:block">
                            <i class="fi fi-rr-check"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Combobox -->


    </div>
</div>
@endsection
