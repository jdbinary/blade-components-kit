<x-layouts.layout>
    <div class="absolute right-6 top-1">
        <x-toggle icons="true" color="primary" shape="circle" />
    </div>
    <div class="bg-muted flex min-h-svh flex-col items-center justify-center gap-6 p-6 md:p-10">
        <div class="flex w-full max-w-md flex-col gap-6">
            <x-link href="{{ route('home') }}" class="flex flex-col items-center gap-2 font-medium" wire:navigate>
                <span class="flex items-center justify-center text-primary-950 dark:text-primary-100">
                    <img src="{{ asset('img/blade.svg') }}" alt="Blade Custom Kit Logo" width="256">
                </span>

                <span class="sr-only">{{ config('app.name', 'Laravel') }}</span>
            </x-link>

            <div class="flex flex-col gap-6">
                <div class="rounded-xl  bg-primary-100 dark:bg-primary-950  shadow-xl dark:shadow-xl">
                    <div class="px-10 py-8">{{ $slot }}</div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.layout>
