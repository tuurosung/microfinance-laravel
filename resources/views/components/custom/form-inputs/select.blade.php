@props([
    'label' => '',
    'id' => '',
    'name' => '',
    'options' => [],
    'selected' => '',
    'required' => false
])


<div class="mb-3">
    <label for="hs-select-label" class="block text-sm text-dark font-medium mb-1 dark:text-white">{{ $label }}</label>
    <select name="{{ $name }}" id="{{ $id }}" class="py-2.5 px-4 pe-9 form-control" {{ $required ? 'required' : '' }} {{ $attributes }}>
        <option value="">Choose...</option>

        @foreach ($options as $key => $value)
            <option value="{{ $key }}" {{ $key == $selected ? 'selected' : '' }}>{{ $value }}</option>
        @endforeach
    </select>
</div>
