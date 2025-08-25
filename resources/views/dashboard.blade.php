{{-- Title of the view --}}
@section('title', __('Dashboard'))
<x-layouts.app >
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="grid grid-cols-3 gap-2">
            <div
                class="relative h-[20vh] col-span-3  sm:col-span-2 overflow-hidden rounded-xl border border-primary-200 dark:border-primary-700">
                <x-placeholder-pattern
                    class="absolute inset-0 size-full stroke-primary-900/20 dark:stroke-primary-100/20" />
                
            </div>
            <div
                class="relative h-[20vh] col-span-2 sm:col-span-1 rounded-xl border border-primary-200 dark:border-primary-700">
                <x-placeholder-pattern
                    class="absolute inset-0 size-full stroke-primary-900/20 dark:stroke-primary-100/20" />
            </div>
            <div
                class="relative  h-[20vh] col-span-1 sm:col-span-2 rounded-xl border border-primary-200 dark:border-primary-700">
                <x-placeholder-pattern
                    class="absolute inset-0 size-full stroke-primary-900/20 dark:stroke-primary-100/20" />
            </div>
            <div class="relative  h-[20vh] col-span-1 rounded-xl border border-primary-200 dark:border-primary-700">
                <x-placeholder-pattern
                    class="absolute inset-0 size-full stroke-primary-900/20 dark:stroke-primary-100/20" />
            </div>
            <div class="relative  h-[20vh] col-span-1 rounded-xl border border-primary-200 dark:border-primary-700">
                <x-placeholder-pattern
                    class="absolute inset-0 size-full stroke-primary-900/20 dark:stroke-primary-100/20" />
            </div>
            <div
                class="relative  h-[20vh] col-span-1 sm:col-span-2 rounded-xl border border-primary-200 dark:border-primary-700">
                <x-placeholder-pattern
                    class="absolute inset-0 size-full stroke-primary-900/20 dark:stroke-primary-100/20" />
            </div>
            
        </div>
    </div>
</x-layouts.app>
