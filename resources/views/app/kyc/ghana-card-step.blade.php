<x-layouts::app>

    <div class="mx-auto max-w-7xl pb-10">

        <x-custom.headers.page-header title="KYC Compliance" currentPage="KYC Compliance">

        </x-custom.headers.page-header>

        @include('layouts.errors')


        @include('app.kyc.partials.timeline')



        <form method="POST" action="{{ route('cif.kyc.ghana-card.store', $cif) }}">
            @csrf

            <div class="grid grid-cols-12 gap-6 mt-5">
                <div class="lg:col-span-3 md:col-span-3 sm:col-span-12 col-span-12">

                    @include('custom.cif.profile')
                </div>
                <div class="lg:col-span-9 md:col-span-9 sm:col-span-12 col-span-12">

                    <x-custom.cards.card title="Identity Information">

                        @include('app.kyc.forms.ghana-card-form')


                        <hr class="my-10">


                        <div class="mt-8 flex justify-end">
                            <button type="button"
                                class="btn bg-red-500 btn-danger hover:bg-red-200 text-white me-3 px-7">
                                <i class="fi fi-sr-arrow-left me-3"></i>
                                Return
                            </button>
                            <button type="submit" class="btn bg-primary hover:bg-primaryemphasis text-white px-8">
                                <i class="fi fi-rr-check me-3"></i>
                                Save And Continue
                            </button>
                        </div>



                    </x-custom.cards.card>


                </div>
            </div>

        </form>

    </div>

    @section('scripts')
        <script type="text/javascript">

        </script>
    @endsection
</x-layouts::app>
