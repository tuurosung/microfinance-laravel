@extends('layouts.app')

@section('content')

<x-headers.page-header pageTitle="Deposit Accounts" currentPage="Deposit Accounts">
    <button class="btn-md bg-blue-600 cursor-pointer" data-hs-overlay="#new-account-modal">
        <i class="fi fi-sr-plus-small me-2"></i>
        New Account
    </button>
</x-headers.page-header>


<div class="card">
    <div class="card-body">

        <div class="relative overflow-x-auto bg-neutral-primary-soft shadow-xs rounded-base border border-default">
            <div class="p-4 flex items-center justify-between space-x-4">
                <label for="input-group-1" class="sr-only">Search</label>
                <div class="relative">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                        <i class="fi fi-rr-search"></i>

                    </div>
                    <input type="text" id="input-group-1"
                        class="block w-full max-w-96 ps-9 pe-3 py-2 bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand shadow-xs placeholder:text-body"
                        placeholder="Search">
                </div>
                
            </div>

            <table class="table">
                <thead>
                    <tr>
                        <!-- <th scope="col" class="p-4">
                    <div class="flex items-center">
                        <input id="table-checkbox-20" type="checkbox" value=""
                            class="w-4 h-4 border border-default-medium rounded-xs bg-neutral-secondary-medium focus:ring-2 focus:ring-brand-soft">
                        <label for="table-checkbox-20" class="sr-only">Table checkbox</label>
                    </div>
                </th> -->
                        <th scope="col">
                            #
                        </th>
                        <th scope="col">
                            Date
                        </th>
                        <th scope="col">
                            Account Name
                        </th>
                        <th scope="col">
                            Account Type
                        </th>
                        <th scope="col">
                            Primary Cif
                        </th>
                        <th scope="col">
                            Opening Balance
                        </th>
                        <th scope="col">
                            Min. Balance
                        </th>
                        <th scope="col">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($accounts as $account)
                    <tr>
                        <!-- <td class="w-4 p-4">
                                    <div class="flex items-center">
                                        <input id="table-checkbox-21" type="checkbox" value=""
                                            class="w-4 h-4 border border-default-medium rounded-xs bg-neutral-secondary-medium focus:ring-2 focus:ring-brand-soft">
                                        <label for="table-checkbox-21" class="sr-only">Table checkbox</label>
                                    </div>
                                </td> -->
                        <!-- <th scope="row" class="px-6 py-4 font-medium text-heading whitespace-nowrap">
                        #
                    </th> -->
                        <td scope="row">
                            {{ $loop->iteration }}
                        </td>
                        <td scope="row" class="px-6 py-4 font-normal text-heading whitespace-nowrap">
                            {{ $account->created_at }}
                        </td>
                        <td class="underline">
                            <a href="{{ route('accounts.show', $account) }}">
                                {{ $account->account_name }}
                            </a>
                        </td>
                        <td>
                            {{ $account->account_type->label() }}
                        </td>
                        <td>
                            {{ $account->primaryCif?->full_name }}
                        </td>
                        <td>
                            {{ $account->opening_balance }}
                        </td>
                        <td>
                            {{ $account->minimum_balance_pesewas }}
                        </td>
                        <td class="text-end">
                            <a href="{{ route('accounts.show', $account) }}"
                                class="font-medium text-blue-600 hover:underline">
                                View
                                <i class="fi fi-rr-arrow-right ms-1"></i>
                            </a>
                        </td>

                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>

    </div>
</div>

<livewire:accounts.new-account />

@endsection

@section('js')
<script>
    (function() {
        const {
            element
        } = HSComboBox.getInstance('#hs-combobox-basic-usage', true);
        const getData = document.querySelector('#hs-log-combobox-basic-usage-current-data');
        getData.addEventListener('click', () => console.log(element.getCurrentData()));
    })();
</script>
@endsection
