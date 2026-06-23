@props([
    'modalId' => 'modal-id',
    'modalTitle' => 'Modal Title',

])

<div class="flex justify-between items-center py-3 px-6 border-b border-border dark:border-gray-700">
    <h3 class="font-normal text-2xl font-cal-sans-regular text-gray-800 dark:text-white">
        {{ $modalTitle }}
    </h3>
    <button type="button"
        class="flex justify-center items-center size-7 text-sm font-semibold rounded-full border border-transparent text-gray-800 hover:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none dark:text-white dark:hover:bg-gray-700 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600 cursor-pointer"
        data-hs-overlay="#{{ $modalId }}">
        <span class="sr-only">Close</span>
        <i class="fi fi-rr-cross-small text-xl"></i>
    </button>
</div>
