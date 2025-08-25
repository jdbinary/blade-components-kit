<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">

<head>
    @include('partials.head')
</head>

<body class="min-h-screen bg-primary-100 antialiased dark:bg-linear-to-b dark:from-primary-950 dark:to-primary-900">

    <div
        class="relative grid h-dvh flex-col items-center justify-center px-8 sm:px-0 lg:max-w-none lg:grid-cols-2 lg:px-0">
        <div class="absolute right-6 top-1">
            <x-toggle icons="true" color="primary" shape="circle" />
        </div>
        <div class="bg-muted relative hidden h-full flex-col p-10 lg:flex dark:border-e dark:border-primary-800">
            <div class="absolute inset-0 bg-primary-50 dark:bg-primary-900"></div>
            <a href="{{ route('home') }}"
                class="relative z-20 flex items-center text-lg font-medium text-primary-950 dark:text-primary-100"
                wire:navigate>
                <span class="flex h-10 w-10 items-center justify-center rounded-md ">
                    <x-icon name="logo-laravel" size="10" />
                </span>
                {{ config('app.name', 'Laravel') }}
            </a>

            @php
                [$message, $author] = str(Illuminate\Foundation\Inspiring::quotes()->random())->explode('-');
            @endphp

            <div class="relative z-20 mt-auto">
                <blockquote class="space-y-2">
                    <flux:heading size="lg">&ldquo;{{ trim($message) }}&rdquo;</flux:heading>
                    <footer>
                        <flux:heading>{{ trim($author) }}</flux:heading>
                    </footer>
                </blockquote>
            </div>
        </div>
        <div class="w-full lg:p-8">
            <div class="mx-auto flex w-full flex-col justify-center space-y-6 sm:w-[350px]">
                <a href="{{ route('home') }}" class="z-20 flex flex-col items-center gap-2 font-medium lg:hidden"
                    wire:navigate>
                    <span class="flex h-9 w-9 items-center justify-center rounded-md">
                        <x-app-logo-icon class="size-9 fill-current text-black dark:text-white" />
                    </span>

                    <span class="sr-only">{{ config('app.name', 'Laravel') }}</span>
                </a>
                {{ $slot }}
            </div>
        </div>
    </div>
    @fluxScripts
</body>

</html>
