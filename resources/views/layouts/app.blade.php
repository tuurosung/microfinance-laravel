@include('layouts::partials.header')

<body class="DEFAULT_THEME dark:bg-dark" style="background-color: #f4f7fb !important;">


    <main>
        <!--start the project-->
        <div id="main-wrapper" class="flex">

            @include('layouts::partials.application-sidebar')


            <div class="page-wrapper w-full" role="main">

                @include('layouts::partials.application-top-nav')



                <!-- Main Content -->
                <main class="pt-6" style="background-color: #f4f7fb !important;">
                    <div class="container full-container py-5">

                        @include('layouts.errors')
                        @yield('content')

                        <!-- Page Hader Goes Here -->

                        <!-- <div class="grid grid-cols-12 gap-6">

                            <div class=" lg:col-span-4 md:col-span-6 sm:col-span-12 col-span-12">

                            adhadf

                            </div>

                        </div> -->
                    </div>
            </div>
    </main>
    <!-- Main Content End -->
    </div>



    </div>
    <!--end of project-->
    </main>



    <script>
        function handleColorTheme(e) {
            document.documentElement.setAttribute("data-color-theme", e);
        }
    </script>


    <!-- <script src="../assets/libs/prismjs/prism.js"></script> -->
    <!-- For Datatables -->
    <script src="{{ asset('vendor/vendor.min.js') }}"></script>
    <!-- <script src="{{ asset('vendor/tailwindcss.js') }}"></script> -->
    <script src="https://cdn.datatables.net/2.0.3/js/dataTables.js"></script>
    <script src="https://flowbite.com/docs/flowbite.min.js?v=4.0.1a"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('vendor/loadash.js') }}"></script>
    <script src="{{ asset('vendor/vanilla-calenda.js') }}"></script>
    <!-- For Datatables Init-->
    <script>
        // new DataTable('.datatables', {
        //     scrollX: true,
        // });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/@floating-ui/core@1.7.5"></script>
    <script src="https://cdn.jsdelivr.net/npm/@floating-ui/dom@1.7.6"></script>

    @livewireScripts
</body>
@include('layouts::partials.footer')
@yield('js')

</html>
