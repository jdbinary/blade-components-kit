<x-layouts.layout>
    <div class="absolute right-6 top-3">
        <x-toggle icons="true" color="primary" shape="circle" />
    </div>
    <div class="bg-background flex min-h-svh flex-col items-center justify-center gap-6 p-6 md:p-10">
        <div class="flex w-full max-w-sm flex-col gap-2">
            <a href="{{ route('home') }}" class="flex flex-col items-center gap-2 font-medium" wire:navigate>
                <span
                    class="flex  mb-1 items-center justify-center rounded-md text-primary-950 dark:text-primary-100">
                    <img src="{{ asset('img/blade.svg') }}" alt="Blade Custom Kit Logo" width="256">
                </span>
                <span class="sr-only">{{ config('app.name', 'Laravel') }}</span>
            </a>
            <div class="flex flex-col gap-6">
                {{ $slot }}
            </div>
        </div>
    </div>
</x-layouts.layout>
