
<div class="card mb-5 min-h-[500px]!">
    <div class="card-body">

        <div class="flex">
            <div
                class="flex bg-gray-100 hover:bg-gray-200 rounded-md transition p-1 dark:bg-gray-700 dark:hover:bg-gray-600">
                <nav class="flex space-x-2" aria-label="Tabs" role="tablist">
                    {{ $tabs }}
                </nav>
            </div>
        </div>

        <div class="mt-3 py-4">

            {{ $content }}

        </div>
    </div>
</div>
