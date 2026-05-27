@props([
    'title' => 'Card Title',
    'footer' => ''
])

<div class="card ">
    <div class="card-header card-body border-b-1 border-zinc-200 py-4">
        <h4 class="text-lg font-cal-sans-regular font-light">{{ $title }}</h4>
    </div>
    <div class="card-body">

        {{ $slot }}
    </div>
    <div class="card-footer border-t-1 border-zinc-200 py-4">
        @yield('footer')
    </div>

</div>
