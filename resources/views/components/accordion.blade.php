@props([
    'title' => 'Title here',
    'open' => false,
    'bgColor' => 'none',
    'color' => 'default',
    'width' => '4xl',
    'id' => (string) Str::uuid(), // Accessibility: Unique ID for aria attributes
])

@php
    $bgColorClass = match ($bgColor) {
        'none' => 'bg-transparent hover:bg-transparent text-inherit',
        'primary' => 'bg-primary-500 hover:bg-primary-600 text-primary-950 dark:bg-primary-700 dark:hover:bg-primary-800 dark:text-white',
        'secondary' => 'bg-secondary-500 hover:bg-secondary-600 text-secondary-950 dark:bg-secondary-700 dark:hover:bg-secondary-800 dark:text-white',
        'success' => 'bg-green-500 hover:bg-green-600 text-green-950 dark:text-white dark:bg-green-700 dark:hover:bg-green-800',
        'warning' => 'bg-yellow-500 hover:bg-yellow-600 dark:hover:bg-yellow-800 text-yellow-950 dark:bg-yellow-700 dark:hover:bg-yellow-400 dark:text-white',
        'danger' => 'bg-red-500 hover:bg-red-600 dark:hover:bg-red-800 text-red-950 dark:bg-red-700 dark:hover:bg-red-400 dark:text-white',
        default => 'bg-gray-500 hover:bg-gray-600 text-gray-950 dark:bg-gray-700 dark:hover:bg-gray-800 dark:text-white',
    };

    $colorClass = match ($color) {
        'primary' => 'text-primary-700 dark:text-primary-300 hover:text-primary-900 dark:hover:text-white',
        'secondary' => 'text-secondary-700 dark:text-secondary-300 hover:text-secondary-900 dark:hover:text-white',
        'success' => 'text-green-700 dark:text-green-300 hover:text-green-900 dark:hover:text-white',
        'warning' => 'text-yellow-700 dark:text-yellow-300 hover:text-yellow-900 dark:hover:text-white',
        'danger' => 'text-red-700 dark:text-red-300 hover:text-red-900 dark:hover:text-white',
        default => 'text-gray-700 dark:text-gray-300 dark:hover:text-white hover:text-gray-900',
    };

    $widthClass = match ($width) {
        'full' => 'w-full',
        'auto' => 'w-auto',
        'xl' => 'w-64',
        '2xl' => 'w-80',
        '3xl' => 'w-96',
        '4xl' => 'w-112',
        default => 'w-auto',
    };
@endphp

<div x-data="{ open: @json($open) }" class="relative {{ $widthClass }}">
    <button
        :aria-expanded="open"
        :aria-controls="'accordion-content-{{ $id }}'"
        id="accordion-button-{{ $id }}"
        x-on:click="open = !open"
        class="flex justify-between items-center px-5 py-4 rounded-lg transition-all duration-300 shadow {{ $bgColorClass }} {{ $colorClass }} w-full cursor-pointer"
    >
        <span class="font-semibold">{{ $title }}</span>
        <div class="transform transition-transform duration-300" :class="{ 'rotate-180': open }">
            <x-icon name="chevron-down" size="5" />
        </div>
    </button>

    <div
        x-ref="content"
        x-bind:style="open ? 'max-height: ' + $refs.content.scrollHeight + 'px' : 'max-height: 0px'"
        id="accordion-content-{{ $id }}"
        role="region"
        aria-labelledby="accordion-button-{{ $id }}"
        class="overflow-hidden transition-all duration-500 ease-in-out max-h-0"
    >
        <div class="px-5 pt-3 py-4 my-1 text-sm text-gray-600 dark:text-gray-300 bg-white dark:bg-neutral-800 border-t border-gray-200 dark:border-neutral-700 rounded-lg shadow">
            {{ $slot }}
        </div>
    </div>
</div>
