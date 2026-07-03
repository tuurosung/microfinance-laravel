@props([
    'icon' => null,
    'label' => null,
    'href' => 'javascript:void(0);',
    'iconColour' => 'black'
])


<a
    href="{{ $href }}" {{ $attributes->merge(['class' => 'flex items-center gap-x-3.5 py-2 px-3 rounded-md text-[13px] text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300 dark:focus:bg-gray-700']) }}>
    <i class="fi fi-sr-{{ $icon }} text-{{ $iconColour }}"></i>
    {{ $label }}
</a>
