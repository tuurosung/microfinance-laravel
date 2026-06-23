<aside id="application-sidebar-brand"
    class="hs-overlay hs-overlay-open:translate-x-0 -translate-x-full xl:rtl:-translate-x-0 rtl:translate-x-full  left-0 rtl:left-auto rtl:right-0 transform hidden xl:block xl:translate-x-0 xl:end-auto xl:bottom-0 fixed top-0 with-vertical  left-sidebar transition-all duration-300 h-screen xl:z-[2] z-[60] flex-shrink-0 border-r rtl:border-l rtl:border-r-0 w-[270px] border-border dark:border-darkborder bg-white dark:bg-dark">
    <!-- ---------------------------------- -->
    <!-- Start Vertical Layout Sidebar -->
    <!-- ---------------------------------- -->
    <div class="py-5 px-5 flex justify-between">
        <div class="brand-logo flex  items-center w-full">
            <a href="../main/index.html" class="text-nowrap logo-img">
                <img src="{{ asset('images/logo.png') }}" class="dark:hidden block rtl:hidden w-40!" alt="Logo-Dark">
                <img src="{{ asset('images/logo.png') }}" class="dark:block hidden rtl:hidden rtl:dark:hidden w-fit!" alt="Logo-light">

                <img src="{{ asset('images/logo.png') }}"
                    class="dark:hidden hidden rtl:block rtl:dark:hidden w-fit!" alt="Logo-Dark">
                <img src="{{ asset('images/logo.png') }}"
                    class="dark:hidden hidden rtl:hidden rtl:dark:block w-fit!" alt="Logo-light">
            </a>
        </div>

    </div>
    <div class="overflow-hidden">
        <div class="scroll-sidebar simplebar-scrollable-y" data-simplebar="init">
            <div class="simplebar-wrapper" style="margin: 0px;">
                <div class="simplebar-height-auto-observer-wrapper">
                    <div class="simplebar-height-auto-observer"></div>
                </div>
                <div class="simplebar-mask">
                    <div class="simplebar-offset" style="right: 0px; bottom: 0px;">
                        <div class="simplebar-content-wrapper" tabindex="0" role="region"
                            aria-label="scrollable content" style="height: 100%; overflow: hidden scroll;">
                            <div class="simplebar-content" style="padding: 0px;">
                                <div class="px-6 mt-8 mini-layout" data-te-sidenav-menu-ref="">
                                    <nav class="hs-accordion-group w-full flex flex-col">
                                        <ul data-te-sidenav-menu-ref="" id="sidebarnav">



                                            <li class="sidebar-item">
                                                <a class="sidebar-link dark-sidebar-link flex align-middle" href="{{ route('dashboard') }}">
                                                    <i class="fi fi-rr-paper-plane shrink-0"></i>
                                                    <span class="hide-menu shrink-0 my-0">Dashboard</span>
                                                </a>
                                            </li>

                                            <li class="hs-accordion sidebar-item" id="blog-accordion">
                                                <a class="hs-accordion-toggle sidebar-link dropdown-menu-link">
                                                    <i class="fi fi-rr-briefcase  shrink-0"></i> <span class="hide-menu">Accounts</span>
                                                    <span class="hide-menu ms-auto">
                                                        <i class="fi fi-rr-angle-down ms-auto  hs-accordion-active:hidden! "></i>
                                                        <i class="fi fi-rr-angle-up ms-auto hs-accordion-active:block! ml-auto hidden! z-10 relative"></i>
                                                    </span>
                                                </a>

                                                <div id="blog-accordion" class="hs-accordion-content " style="display: none;">
                                                    <ul class="">
                                                        <li class="pl-4 pr-3">
                                                            <a class="dropdown-submenu-link " href="{{ route('deposit-accounts.index') }}">
                                                                <i class="ti ti-circle flex-shrink-0 text-xs me-3 "></i>
                                                                <span class="hide-menu">New Account</span>
                                                            </a>
                                                        </li>
                                                        <li class="pl-4 pr-3">
                                                            <a class="dropdown-submenu-link " href="{{ route('deposit-accounts.index') }}">
                                                                <i class="ti ti-circle flex-shrink-0 text-xs me-3 "></i>
                                                                <span class="hide-menu">Existing Accounts</span>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </li>
                                            <li class="hs-accordion sidebar-item" id="">
                                                <a class="hs-accordion-toggle sidebar-link dropdown-menu-link">
                                                    <i class="fi fi-rr-users  shrink-0"></i>
                                                    <span class="hide-menu">CIFs</span>
                                                    <span class="hide-menu ms-auto">
                                                        <i class="fi fi-rr-angle-down ms-auto  hs-accordion-active:hidden! "></i>
                                                        <i class="fi fi-rr-angle-up ms-auto hs-accordion-active:block! ml-auto hidden! z-10 relative"></i>
                                                    </span>
                                                </a>

                                                <div id="blog-accordion" class="hs-accordion-content " style="display: none;">
                                                    <ul class="">
                                                        <li class="pl-4 pr-3">
                                                            <a class="dropdown-submenu-link " href="{{ route('cif.create') }}">
                                                                <i class="ti ti-circle flex-shrink-0 text-xs me-3 "></i>
                                                                <span class="hide-menu">New CIF</span>
                                                            </a>
                                                        </li>
                                                        <li class="pl-4 pr-3">
                                                            <a class="dropdown-submenu-link " href="{{ route('cif.index') }}">
                                                                <i class="ti ti-circle flex-shrink-0 text-xs me-3 "></i>
                                                                <span class="hide-menu">Existing CIFs</span>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </li>
                                            <li class="hs-accordion sidebar-item" id="">
                                                <a class="hs-accordion-toggle sidebar-link dropdown-menu-link">
                                                    <i class="fi fi-rr-key  shrink-0"></i>
                                                    <span class="hide-menu">KYC</span>
                                                    <span class="hide-menu ms-auto">
                                                        <i class="fi fi-rr-angle-down ms-auto  hs-accordion-active:hidden! "></i>
                                                        <i class="fi fi-rr-angle-up ms-auto hs-accordion-active:block! ml-auto hidden! z-10 relative"></i>
                                                    </span>
                                                </a>

                                                <div id="blog-accordion" class="hs-accordion-content " style="display: none;">
                                                    <ul class="">
                                                        <li class="pl-4 pr-3">
                                                            <a class="dropdown-submenu-link " href="{{ route('cif.create') }}">
                                                                <i class="ti ti-circle flex-shrink-0 text-xs me-3 "></i>
                                                                <span class="hide-menu">Verified KYCs</span>
                                                            </a>
                                                        </li>
                                                        <li class="pl-4 pr-3">
                                                            <a class="dropdown-submenu-link " href="{{ route('cif.index') }}">
                                                                <i class="ti ti-circle flex-shrink-0 text-xs me-3 "></i>
                                                                <span class="hide-menu">Pending KYCs</span>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </li>

                                            <x-sidebar.sidebar-item label="Branches" icon="draw-square" href="#" />


                                            <li class="sidebar-item">
                                                <a class="sidebar-link dark-sidebar-link flex align-middle" href="{{ route('dashboard') }}">
                                                    <i class="fi fi-rr-money-bill-transfer shrink-0"></i>
                                                    <span class="hide-menu shrink-0 my-0">Purchase Payments</span>
                                                </a>
                                            </li>


                                            <li class="sidebar-item">
                                                <a class="sidebar-link dark-sidebar-link flex align-middle" href="{{ route('dashboard') }}">
                                                    <i class="fi fi-rr-member-list shrink-0"></i>
                                                    <span class="hide-menu shrink-0 my-0">Chart Of Accounts</span>
                                                </a>
                                            </li>
                                            <li class="sidebar-item mt-5">
                                                <a class="sidebar-link dark-sidebar-link flex align-middle" href="{{ route('dashboard') }}">
                                                    <i class="fi fi-rr-file-invoice-dollar shrink-0"></i>
                                                    <span class="hide-menu shrink-0 my-0">Fund Transer</span>
                                                </a>
                                            </li>
                                            <li class="sidebar-item">
                                                <a class="sidebar-link dark-sidebar-link flex align-middle" href="{{ route('dashboard') }}">
                                                    <i class="fi fi-rr-file-invoice-dollar shrink-0"></i>
                                                    <span class="hide-menu shrink-0 my-0">Employees</span>
                                                </a>
                                            </li>
                                            <li class="sidebar-item">
                                                <a class="sidebar-link dark-sidebar-link flex align-middle" href="{{ route('dashboard') }}">
                                                    <i class="fi fi-rr-file-invoice-dollar shrink-0"></i>
                                                    <span class="hide-menu shrink-0 my-0">Registered Users</span>
                                                </a>
                                            </li>
                                            <x-sidebar.sidebar-item label="Registered Users" icon="users" href="" />

                                            <li class="sidebar-item mt-6">
                                                <a class=" sidebar-link dark-sidebar-link " href="javascript:void(0)">
                                                    <i class="ti ti-award flex-shrink-0 text-xl"></i> <span
                                                        class="hide-menu">Chip</span>
                                                    <span
                                                        class="ms-auto bg-primary text-white h-6 w-6 rounded-full text-xs flex  items-center justify-center hide-menu-flex">9</span>

                                                </a>
                                            </li>
                                            <li class="sidebar-item">
                                                <a class=" sidebar-link dark-sidebar-link
           " href="javascript:void(0)">
                                                    <i class="ti ti-mood-smile flex-shrink-0  text-xl"></i> <span
                                                        class="hide-menu">Outlined</span>
                                                    <span
                                                        class="ms-auto text-primary outline outline-1 rounded-full outline-primary text-center px-2 text-xs py-1 hide-menu">outline</span>
                                                </a>
                                            </li>

                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="simplebar-placeholder" style="width: 269px; height: 3705px;"></div>
            </div>
            <div class="simplebar-track simplebar-horizontal" style="visibility: hidden;">
                <div class="simplebar-scrollbar" style="width: 0px; display: none;"></div>
            </div>
            <div class="simplebar-track simplebar-vertical" style="visibility: visible;">
                <div class="simplebar-scrollbar"
                    style="height: 25px; transform: translate3d(0px, 0px, 0px); display: block;"></div>
            </div>
        </div>
    </div>

    <!-- Bottom User Profile -->
    <div class="px-6 pt-6  bg-surface  dark:bg-dark-surface relative">
        <div class="bg-lightsecondary dark:bg-darksecondary p-4 rounded-md">
            <div class="hide-menu ">
                <div class="flex items-center">
                    <img src="{{ asset('images/user-1.jpg') }}" class="h-9 w-9 rounded-full object-cover"
                        alt="profile">
                    <div class="ml-4 rtl:mr-4 rtl:ml-0">
                        <h5 class="text-base font-semibold text-dark dark:text-white">{{ auth()->user()->name }}</h5>
                        <p class="text-xs font-normal text-link dark:text-darklink ">Designer</p>
                    </div>
                    <div class="ms-auto hs-tooltip hs-tooltip-toggle">
                        <a href="javascript:void(0)"><i class="ti ti-power text-primary me-3 text-2xl "></i>
                            <span
                                class="tooltip hs-tooltip-content hs-tooltip-shown:opacity-100 hs-tooltip-shown:visible"
                                role="tooltip" style="position: fixed; left: 182.208px; top: 180.85px;">
                                Logout
                            </span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- </aside> -->

</aside>
