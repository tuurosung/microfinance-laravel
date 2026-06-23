@props([
    'name' => null,
    'id' => null,
    'label' => null,
    'placeholder' => null,
    'value' => null
])

<div class="mb-3">
    <label class="block text-sm text-dark font-medium mb-1 dark:text-white"">{{ $label }}</label>
    <input name="{{ $name }}" id="{{ $id }}" type="number" class="py-2.5 px-4 form-control" placeholder="{{ $placeholder }}" value="{{ $value }}" min="0" />
</div>
