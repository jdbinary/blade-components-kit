@props([
    'title' => null,
    'subtitle' => null,
    'description' => null,
    'color' => 'none', 
])

@php
    $bgClass = match ($color) {
        'primary' => 'bg-primary-100 dark:bg-primary-900 text-primary-950 dark:text-primary-100',
        'secondary' => 'bg-secondary-100 dark:bg-secondary-900 text-secondary-950 dark:text-secondary-100',
        'success' => 'bg-green-100 dark:bg-green-900 text-green-900 dark:text-green-100',
        'warning' => 'bg-yellow-100 dark:bg-yellow-900 text-yellow-900 dark:text-yellow-100',
        'danger' => 'bg-red-100 dark:bg-red-900 text-red-900 dark:text-red-100',
        'none' => 'bg-transparent text-gray-900 dark:text-white',
        default => 'bg-primary-50 dark:bg-primary-800 text-gray-800 dark:text-gray-200',
    };

@endphp

<div class="{{ $bgClass }} ">
    <div class="py-16 sm:py-24 px-4 sm:px-6 lg:px-8 mx-auto max-w-7xl">
        <div class="text-start">
            @if ($title)
                <span class="block mb-2 text-lg font-semibold">
                    {{ $title }}
                </span>
            @endif

            @if ($subtitle)
                <h2 class="my-6 text-2xl font-bold sm:text-2xl md:text-2xl">
                    {{ $subtitle }}
                </h2>
            @endif

            @if ($description)
                <p class="text-base my-6">
                    {{ $description }}
                </p>
            @endif
        </div>

        <div>
            {{ $slot }}
        </div>
    </div>
</div>
