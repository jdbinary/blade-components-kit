<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">

<head>
    @include('partials.head')
</head>

<body class="min-h-screen bg-primary-50 antialiased dark:bg-linear-to-b dark:from-primary-950 dark:to-primary-900">

    <div class="flex min-h-screen">
        <div class="flex-1 p-4 max-lg:hidden">
            <div class="relative rounded-lg h-full w-full bg-primary-100 dark:bg-primary-900 flex flex-col items-start justify-end p-16"
                style="background-image: url('/img/auth/image-card.jpg'); background-size: cover">
                <div class="flex gap-2 mb-4">
                    <x-icon name="star" />
                    <x-icon name="star" />
                    <x-icon name="star" />
                    <x-icon name="star" />
                    <x-icon name="star" />
                </div>

                <div class="mb-6 italic font-base text-3xl xl:text-4xl">
                    Flux has enabled me to design, build, and deliver apps faster than ever before.
                </div>

                <div class="flex gap-4">
                    <div class="flex flex-col justify-center font-medium">
                        <div class="text-lg">Caleb Porzio</div>
                        <div class="text-zinc-300">Creator of Livewire</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="absolute right-6 top-2">
            <x-toggle icons="true" color="primary" shape="circle" />
        </div>
        <div class="flex-1 flex justify-center items-center">

            <div class="w-80 max-w-80 space-y-6 mt-2">
                <div class="flex justify-center">
                    <a href="{{ route('home') }}"
                        class="relative z-20 flex items-center text-lg font-medium text-primary-950 dark:text-primary-100"
                        wire:navigate>
                        <span class="flex items-center justify-center rounded-md ">
                            <img src="{{ asset('img/blade.webp') }}" alt="">
                        </span>

                    </a>
                </div>

                @if (Route::is('login'))
                    <div class="space-y-4 border-b pb-2 border-primary-300 dark:border-primary-800">
                        <x-button color="primary" width="full" type="button"
                            onclick="window.location.href='/login/google'">
                            <span class="flex items-center justify-center gap-2">
                                <x-icon name="logo-google" />
                                <span>{{ __('Google') }}</span>
                            </span>
                        </x-button>
                        <x-button color="primary" width="full" class="w-full flex items-center justify-center gap-2">
                            <span class="flex items-center justify-center gap-2">
                                <x-icon name="logo-github" />
                                <span>{{ __('GitHub') }}</span>
                            </span>
                        </x-button>
                    </div>
                @endif

                <div class="flex w-full max-w-sm flex-col gap-2">
                    <div class="flex flex-col gap-6">
                        {{ $slot }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
