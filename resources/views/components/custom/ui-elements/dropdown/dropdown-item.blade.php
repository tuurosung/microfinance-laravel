@props([
    'label' => '',
    'icon' => '',
    'href' => '#',
])

<a class="flex items-center gap-x-3.5 py-2 px-3 rounded-md text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300 dark:focus:bg-gray-700"
    href="{{ $href }}">
    {{ $label }}
</a>
