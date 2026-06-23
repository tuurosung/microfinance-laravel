@props([
    'title' => 'Card Title',
    'footer' => ''
])

<div  {{ $attributes->merge(['class' => 'card bg-white rounded-lg shadow-sm']) }}>
    <div class="card-header card-body border-b border-zinc-200 py-4">
        <h4 class="text-lg font-cal-sans-regular font-light">{{ $title }}</h4>
    </div>
    <div class="card-body">

        {{ $slot }}
    </div>


</div>
