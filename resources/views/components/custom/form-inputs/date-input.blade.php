@props([
    'name' => null,
    'id' => null,
    'label' => null,
    'placeholder' => 'Select date',
    'value' => null,
    'required' => false
])

<div class="mb-3">


    <label class="block text-sm text-dark font-medium mb-1 dark:text-white"">{{ $label }}</label>
    <div class=" relative max-w-sm">

            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                <i class="fi fi-rr-calendar" width="24" height="24"></i>
            </div>
            <input datepicker datepicker-autohide datepicker-format="dd-mm-yyyy" datepicker-autoselect-today
                name="{{ $name }}" id="{{ $id }}" type="text"
                class="block w-full ps-9 pe-3 py-2.5 form-control bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-1 focus:ring-brand focus:border-brand px-3  shadow-xs placeholder:text-body"
                placeholder="{{ $placeholder }}" {{ $required ? 'required' : '' }}>
    </div>

</div>
