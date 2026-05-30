<x-layouts::app :title="__('Customer')">

    <div class="mx-auto max-w-7xl">

        <x-custom.headers.page-header title="CIF List" />

        <div class="flex justify-between mb-3 mt-8">
            <div></div>
            <a type="button"
                href="{{ route('cif.create')  }}"
                class="btn-md text-sm font-medium rounded-md border border-transparent bg-brand hover:bg-primaryemphasis text-white">
                <i class="fi fi-br-user-add me-3"></i>
                Add Customer
            </a>
        </div>


        <div class="relative overflow-x-auto bg-neutral-primary-soft rounded-base border border-default">
            <table class="w-full text-sm text-left rtl:text-right text-body">
                <thead class="text-sm bg-dark text-white border-b rounded-base border-default">
                    <tr>
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
                            Options
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cifs as $cif)
                        <tr class="bg-neutral-primary border-b border-default text-dark font-medium">
                            <td scope="row" class="px-6 py-4 font-medium text-heading whitespace-nowrap">
                                {{ $loop->iteration }}
                            </td>
                            <td scope="row" class="px-6 py-4 font-medium text-heading whitespace-nowrap">
                                {{ $cif->created_at->format('Y-m-d') }}
                            </td>
                            <td scope="row" class="px-6 py-4 font-medium text-heading whitespace-nowrap">
                                {{ $cif->full_name }}
                            </td>
                            <td class="px-6 py-4 text-heading whitespace-nowrap">
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
                                <a href="{{ route('cif.show', $cif) }}" class="underline font-semibold align-middle me-3 text-primary">
                                    Open File
                                </a>

                            </td>
                        </tr>
                    @endforeach


                </tbody>
            </table>


        </div>

    </div>


</x-layouts::app>
