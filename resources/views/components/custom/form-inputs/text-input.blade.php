@props([
    'name' => null,
    'id' => null,
    'label' => null,
    'placeholder' => null,
    'value' => null,
    'required' => false
])

<div class="mb-3">
    <label class="block text-sm text-dark font-medium mb-1 dark:text-white"">{{ $label }}</label>
    <input
        name="{{ $name }}"
        id="{{ $id }}"
        value="{{ $value }}"
        placeholder="{{ $placeholder }}"
        type="text"
        class="py-2.5 px-4 form-control text-sm"  {{ $required ? 'required' : '' }} {{ $attributes }}>
</div>
