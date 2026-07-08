@extends('layouts.app')

@section('content')

<x-headers.page-header pageTitle="Account Dashboard">

    <div class="hs-dropdown relative inline-flex">
        <button id="hs-dropdown-default" type="button" class="btn bg-blue-600 hs-dropdown-toggle inline-flex items-center gap-x-2">
            <span class="leading-tight">
                <i class="fi fi-sr-sack-dollar me-1"></i>
                New Deposit
            </span>
            <i class="ti ti-chevron-down text-base leading-tight font-medium hs-dropdown-open:rotate-180"></i>
        </button>
        <div class="hs-dropdown-menu transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 hidden min-w-60 bg-white shadow-md rounded-md p-2 mt-2 dark:bg-gray-800 dark:border dark:border-gray-700 dark:divide-gray-700 after:h-4 after:absolute after:-bottom-4 after:start-0 after:w-full before:h-4 before:absolute before:-top-4 before:start-0 before:w-full z-10" aria-labelledby="hs-dropdown-default">

            <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-md text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300 dark:focus:bg-gray-700" href="#" data-hs-overlay="#new-deposit-modal">
                <i class="fi fi-rr-angle-small-right"></i>
                Counter Deposit
            </a>
            <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-md text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300 dark:focus:bg-gray-700" href="#">
                <i class="fi fi-rr-angle-small-right"></i>
                Momo Deposit
            </a>

        </div>
    </div>

    <button class="btn bg-blue-600" data-hs-overlay="#new-withdrawal-modal">
        <i class="fi fi-sr-minus me-2"></i>
        Withdrawal
    </button>
</x-headers.page-header>

<div class="card mb-5">
    <div class="card-body">

        <div class="row mb-0!">
            <div class="col-md-6 flex gap-3 items-center">

                <img src="{{ asset('images/user-1.jpg') }}" class="w-15 h-15 rounded-full" />

                <div class="">

                    <h4 class="font-normal font-cal-sans-regular text-2xl mb-2">{{ $account->account_name }}</h4>

                    <div class="flex gap-6">
                        <p>Account Type: {{ $account->account_type->label() }}</p>
                        <p>Account Number: {{ $account->account_number }}</p>
                    </div>

                </div>

            </div>
        </div>

    </div>
</div>


<div class="row">
    <div class="col-md-6">

        <!-- Overview Card -->
        <div class="card mb-3">
            <div class="card-body">
                <h4 class="text-lg">Overview</h5>

                    <div class="row mt-5 mb-0!">
                        <div class="col-md-6 border-r">
                            <p>Account Balance</p>
                            <h3 class="text-2xl font-normal font-cal-sans-regular"> GHS @ghs($balances->availableBalancePesewas)</h3>
                        </div>
                        <div class="col-md-6">
                            <p>Total Deposit</p>
                            <h3 class="text-2xl font-normal font-cal-sans-regular">GHS @ghs($balances->credit)</h3>
                        </div>
                    </div>
            </div>
        </div>


        <div class="card">
            <div class="card-body">

            </div>
        </div>
    </div>
    <div class="col-md-6">

        <!-- Monthly Summary -->
        <div class="card shadow-none">
            <div class="card-body">

                <h4 class="text-lg mb-4">Monthly Summary</h4>

                <div class="row mb-3">
                    <div class="col-md-6">



                        <div class="card border-l-3 border-warning">
                            <div class="card-body bg-white py-4">
                                <p>Deposit</p>
                                <h5 class="text-lg">GHS 23434.08</h5>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-6">

                        <div class="card border-l-3 border-success">
                            <div class="card-body bg-white py-4">
                                <p>Deposit</p>
                                <h5 class="text-lg">GHS 23434.08</h5>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="row mb-0!">
                    <div class="col-md-6">



                        <div class="card border-l-3 border-blue-600">
                            <div class="card-body bg-white py-5">
                                <p>Deposit</p>
                                <h5 class="text-lg">GHS 23434.08</h5>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-6">

                        <div class="card border-l-3 border-s-fuchsia-700">
                            <div class="card-body bg-white py-5">
                                <p>Deposit</p>
                                <h5 class="text-lg">GHS 23434.08</h5>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>

    </div>
</div>


<div class="card">
    <div class="card-body">

        <h3 class="text-xl font-cal-sans-regular font-normal mb-5">Transactions</h3>

        <table class="table">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Type</th>
                    <th>Payee</th>
                    <th>Narration</th>
                    <th class="text-end">Amount</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($account->transactions() as $transaction)
                <tr>
                    <td>{{ $transaction->created_at }}</td>
                    <td>{{ $transaction->type->label() }}</td>
                    <td></td>
                    <td>{{ $transaction->narration }}</td>
                    <td class="text-end">@ghs($transaction->amount_pesewas)</td>
                </tr>
                @endforeach

            </tbody>
        </table>
    </div>
</div>

<livewire:transactions.new-deposit :account="$account" />
<livewire:transactions.new-withdrawal :account="$account" />


@endsection
