@extends('layouts.app')

@section('content')

<x-headers.page-header pageTitle="New Deposit Account">

</x-headers.page-header>

<div class="card">
    <div class="card-body">

        <form action="{{ route('deposit-accountsinitialise') }}" method="POST" class="space-y-6">
            @csrf

            <!-- <h4 class="font-semibold text-lg">Account Information</h4> -->

            <input type="hidden" name="account_opening_session" value="{{ $accountOpeningSession }}" />

            <div class="grid grid-cols-12 gap-6 mb-6">
                <div class="lg:col-span-3 md:col-span-3 sm:col-span-12 col-span-12">
                    <x-custom.form-inputs.select label="Account Type" name="account_type" :options="$accountTypes" selected="{{ old('account_type') }}" required />
                </div>
                <div class="lg:col-span-3 md:col-span-3 sm:col-span-12 col-span-12">
                    <x-custom.form-inputs.number-input label="Min. Balance" name="min_balance" value="{{ old('min_balance') ?? 0 }}" required />
                </div>
                <div class="lg:col-span-3 md:col-span-3 sm:col-span-12 col-span-12">
                    <x-custom.form-inputs.select label="Mandate Type" name="mandate_type" :options="$mandateTypes" selected="{{ old('mandate_type') }}" required />
                </div>
                <div class="lg:col-span-3 md:col-span-3 sm:col-span-12 col-span-12">
                    <x-custom.form-inputs.number-input label="Opening Balance" name="opening_balance"
                        value="{{ old('opening_balance') ?? 0 }}" required />
                </div>
            </div>


            <div class="flex items-center justify-end">
                <button class="btn-md text-sm bg-blue-600 hover:bg-blue-700 text-white ml-3 cursor-pointer" type="submit">
                    Proceed
                    <i class="fi fi-br-arrow-right ms-3"></i>
                </button>
            </div>

        </form>


    </div>
</div>

@endsection
