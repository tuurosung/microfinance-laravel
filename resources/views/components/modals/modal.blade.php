@props([
    'modalId' => 'modal-id',
])

<div id="{{ $modalId }}"
    {{ $attributes->merge(['class' => 'hs-overlay hs-overlay-open:opacity-100 hs-overlay-open:duration-500 hidden size-full fixed top-0 start-0 z-[80] opacity-0 overflow-x-hidden transition-all overflow-y-auto pointer-events-none']) }}>
    <div
        class="hs-overlay-open:mt-7 hs-overlay-open:opacity-100 hs-overlay-open:duration-700 mt-0 opacity-0 ease-out transition-all md:max-w-2xl md:w-full m-3 sm:mx-auto">
        <div
            class="flex flex-col bg-white border shadow-sm rounded-md pointer-events-auto dark:bg-gray-800 dark:border-gray-700 dark:shadow-slate-700/[.7]">

            {{ $slot }}

        </div>
    </div>
</div>
