@props([
    'label' => null,
    'name' => null,
    'id' => null
])


<div class="">
    <label for="small-file-input" class="form-label text-black mb-5">{{ $label }}</label>
            <input
                type="file"
                name="{{ $name }}"
                id="{{ $id }}"
                class="block w-full border
                    border-gray-200  rounded-md text-sm focus:z-10
                    focus:border-blue-500
                    focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none
                    dark:border-gray-700
                    dark:text-gray-400 dark:focus:outline-none dark:focus:ring-1
                    dark:focus:ring-gray-600
                                  file:bg-gray-50 file:border-0
                                  file:me-4
                                  file:py-2.5 file:px-4
                                  dark:file:bg-gray-700 dark:file:text-gray-400">
</div>
