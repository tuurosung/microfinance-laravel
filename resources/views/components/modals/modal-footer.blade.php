@props([
    'modalId' => '',
    'icon' => 'check',
    'btnLabel' => 'Submit'
])
<div class="flex justify-end items-center gap-x-2 py-3 px-6 border-t border-border dark:border-gray-700">
    <button type="button"
        class="btn text-sm font-medium rounded-md border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-slate-900 dark:border-gray-700 dark:text-white dark:hover:bg-gray-800 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600"
        data-hs-overlay="#{{ $modalId }}">
        Close
    </button>
    <button type="submit"
        class="btn-md bg-blue-600 text-sm font-semibold rounded-md border border-transparent text-white hover:bg-primaryemphasis disabled:opacity-50 disabled:pointer-events-none dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600 cursor-pointer">
        <i class="fi fi-rr-{{ $icon }} me-3"></i>
        {{ $btnLabel }}
    </button>
</div>
