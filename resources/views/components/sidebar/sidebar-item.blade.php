@props([
    'active' => false,
    'icon' => null,
    'label' => null,
    'href' => '#',
])

<li  {{ $attributes->merge(['class' => 'sidebar-item mb-0!']) }}>
    <a class="sidebar-link dark-sidebar-link flex align-middle" href="{{ $href }}">
        <i class="fi fi-rr-{{ $icon }} shrink-0"></i>
        <span class="hide-menu shrink-0 my-0">{{ $label }}</span>
    </a>
</li>
