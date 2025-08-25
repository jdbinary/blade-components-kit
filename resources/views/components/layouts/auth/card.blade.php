<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" >

<head>
    @include('partials.head')
</head>

<body class="min-h-screen bg-primary-100 antialiased dark:bg-linear-to-b dark:from-primary-950 dark:to-primary-900">
    <div class="absolute right-6 top-1">
        <x-toggle icons="true" color="primary" shape="circle" />
    </div>
    <div class="bg-muted flex min-h-svh flex-col items-center justify-center gap-6 p-6 md:p-10">
        <div class="flex w-full max-w-md flex-col gap-6">
            <x-link href="{{ route('home') }}" class="flex flex-col items-center gap-2 font-medium" wire:navigate>
                <span class="flex items-center justify-center text-primary-950 dark:text-primary-100">
                    <x-icon name="logo-laravel" size="10" />
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
    @fluxScripts
</body>


</html>
