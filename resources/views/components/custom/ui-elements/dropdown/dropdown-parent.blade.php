@props([
    'label' => '',
    'icon' => '',
    'href' => '#',
])

<div class="hs-dropdown relative inline-flex">
    <button id="hs-dropdown-default" type="button"
        class="hs-dropdown-toggle py-2 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-md border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none dark:bg-transparent dark:border-gray-700 dark:text-white dark:hover:bg-slate-900 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600">
        <span class="leading-tight">{{ $label }}</span>
        <i class="fi fi-br-angle-small-down text-base leading-tight font-medium hs-dropdown-open:rotate-180"></i>
    </button>
    <div class="hs-dropdown-menu transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 hidden min-w-60 bg-white shadow-md rounded-md p-2 mt-2 dark:bg-gray-800 dark:border dark:border-gray-700 dark:divide-gray-700 after:h-4 after:absolute after:-bottom-4 after:start-0 after:w-full before:h-4 before:absolute before:-top-4 before:start-0 before:w-full z-10"
        aria-labelledby="hs-dropdown-default">

        {{ $slot }}

    </div>
</div>
