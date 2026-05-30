<x-layouts::app>

    <div class="mx-auto max-w-5xl">

        <x-custom.headers.page-header title="Create CIF" />



        @include('layouts.errors')

        <form class="space-y-6" method="POST" action="{{ route('cif.store') }}">
            @csrf

            <x-custom.cards.card title="New Customer Information File">

                <div class="grid grid-cols-12 mb-6">
                    <div class="lg:col-span-3 md:col-span-3 sm:col-span-6 col-span-6">
                        <x-custom.form-inputs.select label="Title" name="title" :options="$titleOptions" />
                    </div>
                </div>

                <div class="grid grid-cols-12 gap-6 mb-6">
                    <div class="lg:col-span-6 md:col-span-6 sm:col-span-12 col-span-12">
                        <x-custom.form-inputs.text-input label="First Name" name="first_name"
                            placeholder="eg. Francis" />
                    </div>
                    <div class="lg:col-span-6 md:col-span-6 sm:col-span-12 col-span-12">
                        <x-custom.form-inputs.text-input label="Othernames" name="other_names"
                            placeholder="eg. Alhassan" />
                    </div>
                </div>


                <div class="grid grid-cols-12 gap-6 mb-6">
                    <div class="lg:col-span-3 md:col-span-3 sm:col-span-12 col-span-12">
                        <x-custom.form-inputs.text-input label="Phone Number" name="phone_number"
                            placeholder="0240000000" />
                    </div>
                    <div class="lg:col-span-3 md:col-span-3 sm:col-span-12 col-span-12">
                        <x-custom.form-inputs.text-input label="Secondary Phone" name="secondary_phone"
                            placeholder="0200000000" />
                    </div>
                    <div class="lg:col-span-3 md:col-span-3 sm:col-span-12 col-span-12">
                        <x-custom.form-inputs.select label="Sex" name="sex" id="sex" :options="$sexOptions" />
                    </div>
                    <div class="lg:col-span-3 md:col-span-3 sm:col-span-12 col-span-12">
                        <x-custom.form-inputs.date-input label="Date Of Birth" name="date_of_birth"
                            id="date_of_birth" />
                    </div>
                </div>

                <div class="grid grid-cols-12 gap-6 mb-6">
                    <div class="lg:col-span-6 md:col-span-6 sm:col-span-12 col-span-12">
                        <x-custom.form-inputs.text-input label="Email" name="email" placeholder="you@domain.com" />
                    </div>
                    <div class="lg:col-span-6 md:col-span-6 sm:col-span-12 col-span-12">
                        <x-custom.form-inputs.text-input label="Address" name="residential_address"
                            placeholder="hse no 256, street name" />
                    </div>
                </div>


                <div class="grid grid-cols-12">
                    <div class="col-span-12 flex justify-end">

                        <button class="btn-md btn bg-danger me-3 hover:bg-danger">
                            <i class="fi fi-rr-cross-small me-4"></i>
                            Cancel
                        </button>

                        <button class="btn-md btn">Create CIF
                            <i class="fi fi-rr-arrow-right ms-4"></i>
                        </button>

                    </div>
                </div>

            </x-custom.cards.card>


        </form>


    </div>
</x-layouts::app>
