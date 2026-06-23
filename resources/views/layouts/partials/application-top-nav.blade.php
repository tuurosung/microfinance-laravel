<!--  Header Start -->
<header
    class="sticky top-header top-0 inset-x-0 z-1 flex flex-wrap md:justify-start md:flex-nowrap text-sm  bg-white dark:bg-dark " style="box-shadow: 0 6px 6px rgba(31, 107, 225, 0.1);">
    <div class="with-vertical w-full">
        <div class="w-full mx-auto px-4 lg:py-1 py-3 lg:px-4" aria-label="Global">
            <div class="relative md:flex md:items-center md:justify-between">
                <div class="hs-collapse  grow md:block">
                    <div class="flex justify-between items-center">
                        <div class="flex items-center gap-2">
                            <div class="flex lg:hidden w-10 md:w-full overflow-hidden">
                                <div class="brand-logo flex  items-center ">
                                    <a href="../main/index.html" class="text-nowrap logo-img">
                                        <!-- <img src="../assets/images/logos/dark-logo.svg"
                                            class="dark:hidden block rtl:hidden !w-fit" alt="Logo-Dark" />
                                        <img src="../assets/images/logos/light-logo.svg"
                                            class="dark:block hidden rtl:hidden rtl:dark:hidden !w-fit"
                                            alt="Logo-light" />

                                        <img src="../assets/images/logos/dark-logo-rtl.svg"
                                            class="dark:hidden hidden rtl:block rtl:dark:hidden !w-fit"
                                            alt="Logo-Dark" />
                                        <img src="../assets/images/logos/light-logo-rtl.svg"
                                            class="dark:hidden hidden rtl:hidden rtl:dark:block !w-fit"
                                            alt="Logo-light" /> -->
                                    </a>
                                </div>

                            </div>
                            <div class="relative">
                                <a class="xl:flex hidden text-xl icon-hover cursor-pointer text-link dark:text-darklink sidebartoggler h-10 w-10 hover:text-primary light-dark-hoverbg  justify-center items-center rounded-full"
                                    id="headerCollapse" href="javascript:void(0)">
                                    <i class="fi fi-rr-menu-burger relative"></i>
                                </a>
                                <!--Mobile Sidebar Toggle -->
                                <div class="sticky top-0 inset-x-0 xl:hidden">
                                    <div class="flex items-center">
                                        <!-- Navigation Toggle -->
                                        <a class="text-xl icon-hover cursor-pointer text-link dark:text-darklink sidebartoggler h-10 w-10 hover:text-primary light-dark-hoverbg flex justify-center items-center rounded-full"
                                            data-hs-overlay="#application-sidebar-brand"
                                            aria-controls="application-sidebar-brand" aria-label="Toggle navigation">
                                            <i class="fi fi-rr-users relative"></i>
                                        </a>
                                        <!-- End Navigation Toggle -->
                                    </div>
                                </div>
                                <!-- End Sidebar Toggle -->
                            </div>

                            <a class="hidden lg:flex relative hs-dropdown-toggle cursor-pointer text-xl hover:text-primary text-link dark:text-darklink h-10 w-10 light-dark-hoverbg  justify-center items-center rounded-full"
                                data-hs-overlay="#hs-focus-management-modal">
                                <i class="fi fi-rr-search text-lg relative"></i>
                            </a>

                            <div class="lg:hidden">
                                <button type="button"
                                    class="p-2 inline-flex h-10 w-10 text-link dark:text-darklink hover:text-primary light-dark-hoverbg  justify-center items-center rounded-full"
                                    data-hs-overlay="#navbar-offcanvas-example-menu"
                                    aria-controls="navbar-offcanvas-example-menu" aria-label="Toggle navigation">
                                    <i class="ti ti-apps text-xl"></i>
                                </button>
                            </div>

                            <!-- Menu-->
                            <div id="navbar-offcanvas-example"
                                class="hs-overlay hs-overlay-open:translate-x-0 z-[2] -translate-x-full fixed top-0 start-0 transition-all duration-300 transform h-full max-w-xs bg-white dark:bg-dark  basis-full grow sm:order-1 lg:static lg:block lg:h-auto sm:max-w-none w-[270px] lg:border-r-transparent lg:transition-none lg:translate-x-0  lg:basis-auto hidden "
                                tabindex="-1" data-hs-overlay-close-on-resize>
                                <div class="lg:flex gap-2  items-center ">
                                    <div class="flex lg:hidden lg:p-0 p-5">
                                        <div class="brand-logo flex  items-center ">
                                            <a href="../main/index.html" class="text-nowrap logo-img">
                                                <!-- <img src="../assets/images/logos/dark-logo.svg"
                                                    class="dark:hidden block rtl:hidden !w-fit" alt="Logo-Dark" />
                                                <img src="../assets/images/logos/light-logo.svg"
                                                    class="dark:block hidden rtl:hidden rtl:dark:hidden !w-fit"
                                                    alt="Logo-light" />

                                                <img src="../assets/images/logos/dark-logo-rtl.svg"
                                                    class="dark:hidden hidden rtl:block rtl:dark:hidden !w-fit"
                                                    alt="Logo-Dark" />
                                                <img src="../assets/images/logos/light-logo-rtl.svg"
                                                    class="dark:hidden hidden rtl:hidden rtl:dark:block !w-fit"
                                                    alt="Logo-light" /> -->
                                            </a>
                                        </div>

                                    </div>
                                    <div class="lg:p-0 p-5 lg:flex gap-2 items-center">
                                        <div class="lg:flex items-center hidden">
                                            <div
                                                class="hs-dropdown hidden lg:py-4  [--strategy:static] lg:[--strategy:absolute] [--adaptive:none] sm:[--trigger:hover] relative group/menu">
                                                <button type="button"
                                                    class="header-link-btn group-hover/menu:bg-lightprimary group-hover/menu:text-primary">
                                                    <i class="ti ti-api-app lg:hidden lg:text-sm text-xl"></i>Apps
                                                    <i class="fi fi-rr-angle-down  ms-auto lg:text-sm text-lg"></i>
                                                </button>

                                                <div
                                                    class="hs-dropdown-menu transition-[opacity,margin] duration-[0.1ms] sm:duration-[150ms] hs-dropdown-open:opacity-100 opacity-0 left-0 hidden z-10 sm:mt-3 top-full start-0 min-w-[15rem] lg:w-[900px] before:absolute lg:bg-white bg-transparent dark:bg-dark lg:shadow-md shadow-none">
                                                    <div class="grid grid-cols-12">
                                                        <div
                                                            class="lg:col-span-8 col-span-12 flex items-stretch lg:px-5 lg:pr-0 px-0 py-5">
                                                            <div class="grid grid-cols-12 lg:gap-3 w-full">
                                                                <div
                                                                    class="col-span-12 lg:col-span-6 flex items-stretch">
                                                                    <ul>
                                                                        <li class="mb-5">
                                                                            <a href="../main/app-chat.html"
                                                                                class="flex gap-3 items-center  group relative">
                                                                                <span class="apps-icons">
                                                                                    <!-- <img src="../assets/images/svgs/icon-dd-chat.svg"
                                                                                        class="h-6 w-6"> -->
                                                                                </span>
                                                                                <div class="">
                                                                                    <h6
                                                                                        class="font-semibold text-sm group-hover:text-primary">
                                                                                        Chat Application
                                                                                    </h6>
                                                                                    <p class="text-xs">
                                                                                        New messages
                                                                                        arrived</p>
                                                                                </div>

                                                                            </a>
                                                                        </li>
                                                                        <li class="mb-5">
                                                                            <a href="../main/page-user-profile.html"
                                                                                class="flex gap-3 items-center  group relative">
                                                                                <span class="apps-icons">
                                                                                    <!-- <img src="../assets/images/svgs/icon-dd-invoice.svg"
                                                                                        class="h-6 w-6"> -->
                                                                                </span>
                                                                                <div class="">
                                                                                    <h6
                                                                                        class="font-semibold text-sm group-hover:text-primary ">
                                                                                        User Profile App
                                                                                    </h6>
                                                                                    <p class="text-xs">
                                                                                        Get profile
                                                                                        details</p>
                                                                                </div>
                                                                            </a>
                                                                        </li>
                                                                        <li class="mb-5">
                                                                            <a href="../main/app-contact.html"
                                                                                class="flex gap-3 items-center group relative">
                                                                                <span class="apps-icons">
                                                                                    <!-- <img src="../assets/images/svgs/icon-dd-mobile.svg"
                                                                                        class="h-6 w-6"> -->
                                                                                </span>
                                                                                <div class="">
                                                                                    <h6
                                                                                        class="font-semibold text-sm group-hover:text-primary">
                                                                                        Contact
                                                                                        Application
                                                                                    </h6>
                                                                                    <p class="text-xs">
                                                                                        2 Unsaved
                                                                                        Contacts</p>
                                                                                </div>
                                                                            </a>
                                                                        </li>
                                                                        <li class="mb-5">
                                                                            <a href="../main/app-email.html"
                                                                                class="flex gap-3 items-center group relative">
                                                                                <span class="apps-icons">
                                                                                    <!-- <img src="../assets/images/svgs/icon-dd-message-box.svg"
                                                                                        class="h-6 w-6"> -->
                                                                                </span>
                                                                                <div class="">
                                                                                    <h6
                                                                                        class="font-semibold text-sm group-hover:text-primary">
                                                                                        Email App
                                                                                    </h6>
                                                                                    <p class="text-xs">
                                                                                        Get new emails
                                                                                    </p>
                                                                                </div>

                                                                            </a>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                                <div
                                                                    class="col-span-12 lg:col-span-6 flex items-stretch">
                                                                    <ul>
                                                                        <li class="mb-5">
                                                                            <a href="../main/eco-shop.html"
                                                                                class="flex gap-3 items-center  group relative">
                                                                                <span class="apps-icons">
                                                                                    <!-- <img src="../assets/images/svgs/icon-dd-cart.svg"
                                                                                        class="h-6 w-6"> -->
                                                                                </span>
                                                                                <div class="">
                                                                                    <h6
                                                                                        class="font-semibold text-sm group-hover:text-primary">
                                                                                        eCommerce App

                                                                                    </h6>
                                                                                    <p class="text-xs">
                                                                                        learn more
                                                                                        information</p>
                                                                                </div>


                                                                            </a>
                                                                        </li>
                                                                        <li class="mb-5">
                                                                            <a href="../main/app-calendar.html"
                                                                                class="flex gap-3 items-center group relative">
                                                                                <span class="apps-icons">
                                                                                    <!-- <img src="../assets/images/svgs/icon-dd-mobile.svg"
                                                                                        class="h-6 w-6"> -->
                                                                                </span>
                                                                                <div class="">
                                                                                    <h6
                                                                                        class="font-semibold text-sm group-hover:text-primary">
                                                                                        Calendar App
                                                                                    </h6>
                                                                                    <p class="text-xs">
                                                                                        Get dates</p>
                                                                                </div>


                                                                            </a>
                                                                        </li>
                                                                        <li class="mb-5">
                                                                            <a href="../main/page-account-settings.html"
                                                                                class="flex gap-3 items-center  group relative">
                                                                                <span class="apps-icons">
                                                                                    <!-- <img src="../assets/images/svgs/icon-dd-lifebuoy.svg"
                                                                                        class="h-6 w-6"> -->
                                                                                </span>
                                                                                <div class="">
                                                                                    <h6
                                                                                        class="font-semibold text-sm group-hover:text-primary ">
                                                                                        Account Setting
                                                                                        App

                                                                                    </h6>
                                                                                    <p class="text-xs">
                                                                                        Account settings
                                                                                    </p>
                                                                                </div>

                                                                            </a>
                                                                        </li>
                                                                        <li class="mb-5">
                                                                            <a href="../main/app-notes.html"
                                                                                class="flex gap-3 items-center group relative">
                                                                                <span class="apps-icons">
                                                                                    <!-- <img src="../assets/images/svgs/icon-dd-application.svg"
                                                                                        class="h-6 w-6"> -->
                                                                                </span>
                                                                                <div class="">
                                                                                    <h6
                                                                                        class="font-semibold text-sm group-hover:text-primary">
                                                                                        Notes
                                                                                        Application

                                                                                    </h6>
                                                                                    <p class="text-xs">
                                                                                        To-do and Daily
                                                                                        tasks</p>
                                                                                </div>

                                                                            </a>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                                <div
                                                                    class="col-span-12 md:col-span-12 border-t border-border dark:border-darkborder hidden lg:flex items-stretch pt-4 pr-4">
                                                                    <div
                                                                        class="flex items-center justify-between w-full ">
                                                                        <div
                                                                            class="flex items-center text-dark dark:text-white group">
                                                                            <i
                                                                                class="ti ti-help text-lg text-dark dark:text-darklink group-hover:text-primary"></i>
                                                                            <a href="../main/page-faq.html"
                                                                                class="text-sm font-bold text-dark dark:text-darklink hover:text-primary  ml-2 group-hover:text-primary">
                                                                                Frequently Asked
                                                                                Questions
                                                                            </a>
                                                                        </div>
                                                                        <button type="button" class="btn py-2 px-4 ">
                                                                            Check
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="lg:col-span-4 col-span-12  flex items-strech">
                                                            <div
                                                                class="lg:p-5 lg:border-s border-border dark:border-darkborder">
                                                                <h5
                                                                    class="text-xl font-semibold mb-4 text-dark dark:text-white">
                                                                    Quick Links</h5>
                                                                <ul>
                                                                    <li class="mb-4"><a href="../main/page-pricing.html"
                                                                            class="card-title text-sm hover:text-primary">Pricing
                                                                            Page</a></li>
                                                                    <li class="mb-4"><a
                                                                            href="../main/authentication-login.html"
                                                                            class="card-title text-sm hover:text-primary">Authentication
                                                                            Design</a></li>
                                                                    <li class="mb-4"><a
                                                                            href="../main/authentication-register.html"
                                                                            class="card-title text-sm hover:text-primary">Register
                                                                            Now</a></li>
                                                                    <li class="mb-4"><a
                                                                            href="../main/authentication-error.html"
                                                                            class="card-title text-sm hover:text-primary">404
                                                                            Error
                                                                            Page</a></li>
                                                                    <li class="mb-4"><a href="../main/app-notes.html"
                                                                            class="card-title text-sm hover:text-primary">Notes
                                                                            App</a>
                                                                    </li>
                                                                    <li class="mb-4"><a
                                                                            href="../main/page-user-profile.html"
                                                                            class="card-title text-sm hover:text-primary">User
                                                                            Application</a></li>
                                                                    <li class="mb-4"><a href="../main/blog-posts.html"
                                                                            class="card-title text-sm hover:text-primary">Blog
                                                                            Design</a></li>
                                                                    <li class="mb-4"><a href="../main/eco-checkout.html"
                                                                            class="card-title text-sm hover:text-primary">Shopping
                                                                            Cart</a></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- <div>
                                            <a href="../main/app-chat.html"
                                                class="header-link-btn dark:hover:text-primary">
                                                <i class="ti ti-message-dots lg:hidden lg:text-sm text-xl"></i>Chat</a>
                                        </div>
                                        <div>
                                            <a href="../main/app-calendar.html"
                                                class="header-link-btn dark:hover:text-primary">
                                                <i class="ti ti-calendar lg:hidden lg:text-sm text-xl"></i>Calender</a>
                                        </div>
                                        <div>
                                            <a href="../main/app-email.html"
                                                class="header-link-btn dark:hover:text-primary">
                                                <i class="ti ti-mail lg:hidden lg:text-sm text-xl"></i>Email</a>
                                        </div> -->
                                    </div>
                                </div>
                            </div>
                        </div>


                       @include('layouts::partials.application-notifications')
                    </div>
                </div>
            </div>

        </div>
    </div>
</header>
<!--  Header End -->
