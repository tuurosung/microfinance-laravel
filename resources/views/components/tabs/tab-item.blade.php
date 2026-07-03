@props([
    'active' => false, //bool
    'controls' => null, //bool
    'id' => null,
    'label' => null,
    'icon' => null
])

@php
$base = 'hs-tab-active:bg-white hs-tab-active:text-gray-700 hs-tab-active:dark:bg-gray-800 '
    . 'hs-tab-active:dark:text-gray-400 py-2 px-4 inline-flex items-center gap-x-2 '
    . 'bg-transparent text-sm text-gray-500 hover:text-primary font-medium rounded-md '
    . 'disabled:opacity-50 disabled:pointer-events-none dark:text-gray-400 dark:hover:text-white';
@endphp


<button
    type="button"
    {{ $attributes->class([$base, 'active' => $active]) }}
    id="{{ $id }}"
    role="tab"
    data-hs-tab="#{{ $controls }}"
    aria-controls="{{ $controls }}"
    aria-selected="{{ $active ? 'true' : 'false' }}">

    @if ($icon)
        <i class="fi fi-rr-{{ $icon }}"></i>
    @endif

    {{ $label }}
</button>
