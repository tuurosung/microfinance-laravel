@props([
    'pageTitle' => 'Page Title',
    'currentPage' => 'Current Page',
])
<!----Breadcrumb Start---->
<div class="card bg-white dark:bg-darkinfo   position-relative overflow-hidden mb-6">
    <div class="card-body md:py-3 py-5">
        <div class="items-center grid grid-cols-12 gap-6">
            <div class="col-span-7">
                <h4 class="font-normal text-xl text-dark dark:text-white mb-3 font-cal-sans-regular">{{ $pageTitle }}</h4>
                <ol class="flex items-center whitespace-nowrap" aria-label="Breadcrumb">
                    <li class="flex items-center">
                        <a class="opacity-80 text-sm text-link dark:text-darklink leading-none"
                            href="{{ route('dashboard') }}l">
                            Home
                        </a>
                    </li>
                    <li>
                        <div class="p-0.5 rounded-full bg-dark dark:bg-darklink mx-2.5 flex items-center">
                        </div>
                    </li>
                    <li class="flex items-center text-sm text-link dark:text-darklink leading-none font-semibold" aria-current="page">
                        {{ $currentPage }}
                    </li>
                </ol>
            </div>
            <div class="col-span-5 text-end">
                {{ $slot }}
            </div>
        </div>
    </div>
</div>
<!----Breadcrumb End---->