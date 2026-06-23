@props([
    'active' => false,  // bool — visible when true, hidden otherwise
    'id' => null,   // this panel's id; must equal the tab's `controls` (required)
    'labelledby' => null,   // id of the tab button that controls it; equals the tab's `id` (required)
])

<div
    {{ $attributes->class(['hidden' => !$active]) }}
    id="{{ $id }}"
    role="tabpanel"
    aria-labelledby="{{ $labelledby }}"
>
    {{ $slot }}
</div>
