@php
$customerSelectConfig = [
'hasSearch' => true,
'preventSearchFocus' => true,
'searchPlaceholder' => 'Search...',
'searchClasses' => 'block w-full sm:text-sm bg-transparent border-layer-line rounded-lg text-foreground placeholder:text-muted-foreground-1 focus:border-primary-focus focus:ring-primary-focus before:absolute before:inset-0 before:z-1 py-1.5 sm:py-2 px-3',
'searchWrapperClasses' => 'bg-select p-2 -mx-1 sticky top-0',
'placeholder' => 'Choose customer...',
'toggleTag' => '<button type="button" aria-expanded="false"><span class="me-2" data-icon></span><span class="text-foreground" data-title></span></button>',
'toggleClasses' => 'hs-select-disabled:pointer-events-none hs-select-disabled:opacity-50 relative py-2.5 ps-4 pe-9 flex text-nowrap w-full cursor-pointer bg-layer border border-layer-line text-layer-foreground rounded-lg text-start text-sm hover:bg-layer-hover focus:outline-hidden focus:bg-layer-focus',
'dropdownClasses' => 'mt-2 max-h-72 bg-white pb-1 px-1 space-y-0.5 z-20 w-full bg-select border border-select-line rounded-lg shadow-xl overflow-hidden overflow-y-auto [&::-webkit-scrollbar]:w-2 [&::-webkit-scrollbar-thumb]:rounded-none [&::-webkit-scrollbar-track]:bg-scrollbar-track [&::-webkit-scrollbar-thumb]:bg-scrollbar-thumb',
'optionClasses' => 'hs-selected:bg-select-item-active py-2 px-4 w-full text-sm text-select-item-foreground cursor-pointer hover:bg-select-item-hover rounded-lg focus:outline-hidden focus:bg-select-item-focus',
'optionTemplate' => '<div>
    <div class="flex items-center">
        <div class="me-2" data-icon></div>
        <div class="text-foreground" data-title></div>
    </div>
</div>',
'extraMarkup' => '<div class="absolute top-1/2 inset-e-3 -translate-y-1/2"><svg class="shrink-0 size-3.5 text-muted-foreground-1" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <path d="m7 15 5 5 5-5" />
        <path d="m7 9 5-5 5 5" />
    </svg></div>',
];
@endphp


@props([
    "label" => '',
    "name" => '',
    "placeholder" => "Select an option",
    "options" => []
])

<div class="hs-select relative">
    <label class="form-label">{{ $label }}</label>
    <select name="{{ $name }}" id="{{ $name }}" data-hs-select='@json($customerSelectConfig)' class="hidden" {{ $attributes }}>
        <option value="">{{ $placeholder }}</option>

        @foreach ($options as $key => $value)
        <option value="{{ $key }}">{{ $value }}</option>
        @endforeach

    </select>
</div>
