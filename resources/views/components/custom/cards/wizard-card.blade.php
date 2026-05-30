@props([

    'label' => '',
    'description' => '',
    'icon' => '',
    'color' => 'info'
])

<div class="card ">
    <div class="card-body ">
        <div class="flex gap-5 items-center">
            <i class="fi fi-sr-{{ $icon }} text-{{ $color }}  text-4xl"></i>
            <div>
                <h5 class="text-md text-dark dark:text-darklink font-medium font-cal-sans-regular">
                    {{ $label }}
                </h5>
                <p class="text-xs mb-1">
                    {{ $description }}
                </p>
            </div>
        </div>
    </div>
</div>
