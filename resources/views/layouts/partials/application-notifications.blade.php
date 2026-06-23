<div class="icon-nav items-center gap-3 lg:gap-4 flex">


    <!-- Cart Canvas-->
    <a href="javascript:void(0)"
        class="rounded-full icon-hover h-10 w-10 flex justify-center text-link dark:text-darklink items-center hover:text-primary  relative light-dark-hoverbg "
        data-hs-overlay="#hs-overlay-right-cart">
        <i class="fi fi-rr-shopping-basket text-xl relative "></i>
        <div
            class="absolute inline-flex items-center justify-center w-5 h-5 text-white text-[11px] font-medium  bg-error  rounded-full -top-0 md:-top-[0px] sm:-top-[0px] -right-1">
            2</div>
    </a>
    <!-- Notifications DD -->

    <div class="hs-dropdown [--strategy:absolute] [--adaptive:none] sm:[--trigger:hover] sm:relative group/menu">
        <a id="hs-dropdown-hover-event-notification"
            class="relative hs-dropdown-toggle h-10 w-10 text-link dark:text-darklink cursor-pointer hover:bg-lightprimary  hover:text-primary dark:hover:bg-darkprimary flex justify-center items-center rounded-full group-hover/menu:bg-lightprimary group-hover/menu:text-primary">
            <i class="fi fi-rr-bell text-xl relative z-1"></i>
            <div
                class="absolute inline-flex items-center justify-center  text-white text-[11px] font-medium  bg-primary p-[5px] rounded-full -top-[-5px] -right-[0px]">
            </div>
        </a>
        <div class="card hs-dropdown-menu transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 right-0 rtl:right-auto rtl:left-0 mt-2 min-w-max top-auto w-full sm:w-[360px] hidden z-[2]"
            aria-labelledby="hs-dropdown-hover-event-notification">
            <div class="flex items-center py-4 px-7 justify-between">
                <h3 class="mb-0 card-title">
                    Notifications</h3>
                <span class="text-xs badge-md bg-primary text-white">1
                    new</span>
            </div>
            <div class="message-body max-h-[350px]" data-simplebar="">
                <a href="javascript:void(0)" class="px-7 py-3 flex items-center light-dark-hoverbg">
                    <span
                        class="flex-shrink-0 h-12 w-12 rounded-full bg-lightprimary dark:bg-darkprimary flex justify-center items-center">
                        <i class="fi fi-rr-dashboard text-primary text-xl"></i>
                    </span>
                    <div class="ps-4">
                        <h5 class="text-sm">
                            New Interface Launched
                        </h5>
                        <span>We're changing how you see things</span>
                    </div>
                </a>


            </div>
            <div class="pt-3 pb-6 px-7">
                <a href="#" class="btn btn-outline-primary block w-full">
                    See All Notifications
                </a>
            </div>
        </div>
    </div>
    <!-- Profile DD -->
    <div
        class="hs-dropdown [--strategy:absolute] [--adaptive:none] [--placement:top-left] sm:[--trigger:hover] sm:relative group/menu">
        <a id="hs-dropdown-hover-event-profile"
            class="relative hs-dropdown-toggle cursor-pointer align-middle rounded-full group-hover/menu:bg-lightprimary group-hover/menu:text-primary">
            <img class="object-cover w-9 h-9 rounded-full" src="{{ asset('images/user-1.jpg') }}" alt=""
                aria-hidden="true">
        </a>
        <div class="card hs-dropdown-menu transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 mt-2 min-w-max top-auto right-0 rtl:right-auto rtl:left-0 w-full sm:w-[360px] hidden z-[2]"
            aria-labelledby="hs-dropdown-hover-event-profile">
            <div class="card-body">
                <div class="flex items-center pb-4 justify-between">
                    <h3 class="mb-0 card-title">User
                        Profile</h3>
                </div>
                <div class="message-body max-h-[450px]" data-simplebar="">
                    <div class="">
                        <div class="flex items-center">
                            <img src="{{ asset('images/user-1.jpg') }}" class="h-20 w-20 rounded-full object-cover"
                                alt="profile">
                            <div class="ml-4 rtl:mr-4 rtl:ml-auto">
                                <h5 class="text-base">
                                    {{ auth()->user()->name }}
                                </h5>
                                <p class="text-xs font-normal text-link dark:text-darklink ">
                                    {{ auth()->user()->access_level }}</p>
                            </div>
                        </div>

                        <ul class="mt-10">
                            <li class="mb-5">
                                <a href="javascript:void(0)" class="flex gap-3 items-center group">
                                    <span
                                        class="bg-primary text-white dark:bg-darkgray  h-12 w-12 flex justify-center items-center rounded-md">
                                        <i class="fi fi-rr-user text-2xl"></i>
                                    </span>

                                    <div class="">
                                        <h6 class="text-sm mb-1  group-hover:text-primary">
                                            My Profile
                                        </h6>
                                        <p class="text-xs text-link dark:text-darklink font-normal">
                                            Account settings</p>
                                    </div>
                                </a>
                            </li>
                            <li class="mb-5">
                                <a href="javascript:void(0)" class="flex gap-3 items-center  group">
                                    <span class="bg-warning text-white dark:bg-darkgray  h-12 w-12 flex justify-center items-center rounded-md">
                                        <i class="fi fi-rr-envelope text-2xl"></i>
                                    </span>
                                    <div class="">
                                        <h6 class="fext-sm mb-1  group-hover:text-primary ">
                                            My Inbox
                                        </h6>
                                        <p class="text-xs text-link dark:text-darklink font-normal">
                                            Messages &amp;
                                            Emails</p>
                                    </div>
                                </a>
                            </li>

                        </ul>
<!--
                        <div class="p-5 rounded-md bg-lightprimary dark:bg-darkprimary overflow-hidden relative">
                            <h5 class="text-base leading-4 ">
                                Unlimited<br>
                                Access
                            </h5>
                            <button type="button" class="btn btn-md mt-4">
                                Upgrade
                            </button>
                            <img src="../assets/images/backgrounds/unlimited-bg.png" alt="bg-img"
                                class="absolute right-0 top-0">
                        </div> -->
                    </div>
                </div>
                <div class="mt-5">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                    <button type="submit" class="btn btn-outline-primary block w-full">
                        Logout
                    </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
