<x-layouts::app :title="__('Dashboard')">


    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        
        <div class="grid auto-rows-min gap-4 md:grid-cols-4">
            <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                <x-placeholder-pattern class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" />
            </div>
            <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                <x-placeholder-pattern class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" />
            </div>
            <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                <x-placeholder-pattern class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" />
            </div>
            <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                <x-placeholder-pattern class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" />
            </div>
        </div>

        <div class="grid auto-rows-min gap-4 md:grid-cols-2">

            <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700 h-full">
                <flux:card class="space-y-6">
                    <div class="flex">
                        <div class="flex-1">
                            <flux:heading size="lg">Are you sure?</flux:heading>

                            <flux:text class="mt-2">
                                Your post will be deleted permanently.<br>
                                This action cannot be undone.
                            </flux:text>
                        </div>

                        <div class="-mx-2 -mt-2">
                            <flux:button variant="ghost" size="sm" icon="x-mark" inset="top right bottom" />
                        </div>
                    </div>

                    <div class="flex gap-4">
                        <flux:spacer />
                        <flux:button variant="ghost">Undo</flux:button>
                        <flux:button variant="danger">Delete</flux:button>
                    </div>
                </flux:card>
            </div>
            <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                <x-placeholder-pattern class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" />
            </div>
        </div>
        <div class="relative h-full flex-1 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
            <x-placeholder-pattern class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" />
        </div>
    </div>


</x-layouts::app>
