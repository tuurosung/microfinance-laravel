@extends('layouts.app')


@section('content')
<x-headers.page-header pageTitle="CIF List">
    <a type="button" href="{{ route('cif.create')  }}"
        class="">
        <button class="btn btn-primary" type="link" href="#">Create CIF
            <i class="fi fi-rr-arrow-right ms-4"></i>
        </button>
    </a>

</x-headers.page-header>

<x-custom.cards.card title="Registered CIFs">

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
            <button id="dropdownDefaultButton" data-dropdown-toggle="dropdown"
                class="shrink-0 inline-flex items-center justify-center text-body bg-neutral-secondary-medium box-border border border-default-medium hover:bg-neutral-tertiary-medium hover:text-heading focus:ring-4 focus:ring-neutral-tertiary shadow-xs font-medium leading-5 rounded-base text-sm px-3 py-2 focus:outline-none"
                type="button">

                <i class="fi fi-rr-filter me-2"></i>
                Filter by
                <i class="fi fi-rr-angle-down ms-3"></i>

            </button>
            <!-- Dropdown menu -->
            <div id="dropdown"
                class="z-10 hidden bg-neutral-primary-medium border border-default-medium rounded-base shadow-lg w-32">
                <ul class="p-2 text-sm text-body font-medium" aria-labelledby="dropdownDefaultButton">
                    <li>
                        <a href="#"
                            class="inline-flex items-center w-full p-2 hover:bg-neutral-tertiary-medium hover:text-heading rounded">Color</a>
                    </li>
                    <li>
                        <a href="#"
                            class="inline-flex items-center w-full p-2 hover:bg-neutral-tertiary-medium hover:text-heading rounded">Category</a>
                    </li>
                    <li>
                        <a href="#"
                            class="inline-flex items-center w-full p-2 hover:bg-neutral-tertiary-medium hover:text-heading rounded">Price</a>
                    </li>
                    <li>
                        <a href="#"
                            class="inline-flex items-center w-full p-2 hover:bg-neutral-tertiary-medium hover:text-heading rounded">Sign
                            out</a>
                    </li>
                </ul>
            </div>
        </div>

        <table class="w-full text-sm text-left rtl:text-right text-body">
            <thead
                class="text-sm text-body bg-neutral-secondary-medium border-b border-t border-default-medium">
                <tr>
                    <!-- <th scope="col" class="p-4">
                    <div class="flex items-center">
                        <input id="table-checkbox-20" type="checkbox" value=""
                            class="w-4 h-4 border border-default-medium rounded-xs bg-neutral-secondary-medium focus:ring-2 focus:ring-brand-soft">
                        <label for="table-checkbox-20" class="sr-only">Table checkbox</label>
                    </div>
                </th> -->
                    <th scope="col" class="px-6 py-3 font-medium">
                        #
                    </th>
                    <th scope="col" class="px-6 py-3 font-medium">
                        Date
                    </th>
                    <th scope="col" class="px-6 py-3 font-medium">
                        Cif Name
                    </th>
                    <th scope="col" class="px-6 py-3 font-medium">
                        Sex
                    </th>
                    <th scope="col" class="px-6 py-3 font-medium">
                        Age
                    </th>
                    <th scope="col" class="px-6 py-3 font-medium">
                        Phone
                    </th>
                    <th scope="col" class="px-6 py-3 font-medium">
                        Email
                    </th>
                    <th scope="col" class="px-6 py-3 font-medium text-end">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cifs as $cif)
                <tr class="bg-neutral-primary-soft border-b border-default hover:bg-neutral-secondary-medium font-medium text-dark">
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
                    <th scope="row" class="px-6 py-4 font-normal text-heading whitespace-nowrap">
                        {{ $loop->iteration }}
                    </th>
                    <th scope="row" class="px-6 py-4 font-normal text-heading whitespace-nowrap">
                        {{ $cif->created_at->format('Y-m-d') }}
                    </th>
                    <td class="px-6 py-4 underline">
                        <a href="{{ route('cif.show', $cif) }}">{{ $cif->full_name }}</a>
                    </td>
                    <td class="px-6 py-4">
                        {{ $cif->sex?->label() }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $cif->age }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $cif->phone_number }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $cif->email }}
                    </td>
                    <td class="px-6 py-4 text-end">
                        <a href="{{ route('cif.show', $cif) }}"
                            class="font-medium text-fg-brand hover:underline">
                            Open File
                        </a>
                    </td>
                </tr>
                @endforeach

                <!-- <tr class="bg-neutral-primary-soft border-b border-default hover:bg-neutral-secondary-medium">
                <td class="w-4 p-4">
                    <div class="flex items-center">
                        <input id="table-checkbox-21" type="checkbox" value=""
                            class="w-4 h-4 border border-default-medium rounded-xs bg-neutral-secondary-medium focus:ring-2 focus:ring-brand-soft">
                        <label for="table-checkbox-21" class="sr-only">Table checkbox</label>
                    </div>
                </td>
                <th scope="row" class="px-6 py-4 font-medium text-heading whitespace-nowrap">
                    Apple MacBook Pro 17"
                </th>
                <td class="px-6 py-4">
                    Silver
                </td>
                <td class="px-6 py-4">
                    Laptop
                </td>
                <td class="px-6 py-4">
                    $2999
                </td>
                <td class="px-6 py-4">
                    <a href="#" class="font-medium text-fg-brand hover:underline">Edit</a>
                </td>
            </tr> -->
            </tbody>
        </table>
    </div>

</x-custom.cards.card>
@endsection
