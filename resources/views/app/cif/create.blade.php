<x-layouts::app>

    <div class="mx-auto max-w-5xl">

        <div class="mb-9 flex justify-between">
            <div>
                <flux:heading size="xl" level="1" class="font-cal-sans-regular">{{ __('New CIF') }}</flux:heading>
                <flux:subheading size="lg">{{ __('Create a new cif') }}</flux:subheading>
            </div>
            <div>

            </div>
        </div>

        @include('layouts.errors')

        <form class="space-y-6" method="POST" action="{{ route('cif.store') }}">
            @csrf
            <flux:card class="rounded-1">

                <h1 class="text-2xl text-dark dark:text-white font-cal-sans-regular my-3">Create A New CIF</h1>

                <flux:separator class="mb-8 "/>

                <div class="grid grid-cols-12 gap-6 mb-6">
                    <div class="lg:col-span-3 md:col-span-4 sm:col-span-6 col-span-6">
                        <flux:select name="title" label="Title" placeholder="Select title ....">
                            <flux:select.option value="mr">Mr.</flux:select.option>
                            <flux:select.option value="mrs">Mrs.</flux:select.option>
                            <flux:select.option value="miss">Miss</flux:select.option>
                            <flux:select.option value="rev">Rev</flux:select.option>
                        </flux:select>
                    </div>
                </div>

                <div class="grid grid-cols-12 gap-6 mb-6">
                    <div class="lg:col-span-6 md:col-span-6 sm:col-span-12 col-span-12">
                        <flux:input type="text" icon="user" name="firstname" label="Firstname" required />
                    </div>
                    <div class="lg:col-span-6 md:col-span-6 sm:col-span-12 col-span-12">
                        <flux:input type="text" icon="user" name="othernames" label="Othernames" required />
                    </div>
                </div>


                <!-- row with 2 columns -->
                <div class="grid grid-cols-12 gap-6 mb-6">
                    <div class="lg:col-span-3 md:col-span-3 sm:col-span-12 col-span-12">
                        <flux:input type="text" icon="phone" name="phone_number" label="Phone Number" required />
                    </div>
                    <div class="lg:col-span-3 md:col-span-3 sm:col-span-12 col-span-12">
                        <flux:input type="text" icon="phone" name="secondary_phone" label="Secondary Phone" required />
                    </div>
                    <div class="lg:col-span-6 md:col-span-6 sm:col-span-12 col-span-12">
                        <flux:input type="text" icon="envelope" name="email" label="Email" required />
                    </div>
                </div>


                <div class="grid grid-cols-12 gap-6 mb-6">
                    <div class="lg:col-span-3 md:col-span-3 sm:col-span-12 col-span-12">
                        <flux:select icon="user-minus" name="sex" label="Sex" placeholder="Select sex ..." required>
                            <flux:select.option value="male">Male</flux:select.option>
                            <flux:select.option value="female">Female</flux:select.option>
                        </flux:select>
                    </div>
                    <div class="lg:col-span-3 md:col-span-3 sm:col-span-12 col-span-12">
                        <flux:input label="Date of birth" type="date" name="date_of_birth" required />
                    </div>
                    <div class="lg:col-span-6 md:col-span-6 sm:col-span-12 col-span-12">
                        <flux:input icon="map-pin" name="residential_address" id="residential_address" label="Address"
                            rows="1" required />
                    </div>
                </div>


                <div class="flex justify-end gap-3">
                    <flux:button variant="danger" color="" class="px-8 pe-8 ps-8 cursor-pointer" icon="x-mark">
                        Cancel
                    </flux:button>
                    <flux:button type="submit" variant="primary" color="blue" class="border-0 shadow-none px-8"
                        icon:trailing="arrow-long-right" class="cursor-pointer">
                        Next
                    </flux:button>
                </div>

            </flux:card>
        </form>


    </div>
</x-layouts::app>
