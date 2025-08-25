@props([
    'title' => 'Scroll to Top',
    'icon' => 'chevron-up',
    'bgColor' => 'secondary',
    'size' => 'w-10 h-10',
    'shape' => 'rounded-full',
    'showAfter' => 100,
])

@php
    $bgColorClass = match ($bgColor) {
        'none' => 'bg-transparent hover:bg-transparent text-inherit',
        'primary'
            => 'bg-primary-500 hover:bg-primary-600 text-primary-950 dark:bg-primary-700 dark:hover:bg-primary-800 dark:text-white',
        'secondary'
            => 'bg-secondary-500 hover:bg-secondary-600 text-secondary-950 dark:bg-secondary-700 dark:hover:bg-secondary-800 dark:text-white',
        'success'
            => 'bg-green-500 hover:bg-green-600 text-green-950 dark:text-white dark:bg-green-700 dark:hover:bg-green-800',
        'warning'
            => 'bg-yellow-500 hover:bg-yellow-600 text-yellow-950 dark:bg-yellow-700 dark:hover:bg-yellow-400 dark:text-white',
        'danger' => 'bg-red-500 hover:bg-red-600 text-red-950 dark:bg-red-700 dark:hover:bg-red-400 dark:text-white',
        default
            => 'bg-gray-500 hover:bg-gray-600 text-gray-950 dark:bg-gray-700 dark:hover:bg-gray-800 dark:text-white',
    };

    $shapeClass = match ($shape) {
        'rounded' => 'rounded',
        'rounded-full' => 'rounded-full',
        'square' => 'rounded-none',
        default => 'rounded',
    };


    $buttonClass = $bgColor !== 'default' ? $bgColorClass : $colorClass;
@endphp


<div x-data="{ visible: false }" x-init="window.addEventListener('scroll', () => visible = window.scrollY > {{ $showAfter }})">
    <a href="#" x-show="visible" x-transition x-on:click.prevent="window.scrollTo({ top: 0, behavior: 'smooth' })"
        class="group fixed z-50 flex items-center justify-center bottom-[1rem] right-[1rem] {{ $size }} {{ $buttonClass }} {{ $shape }} transition-colors duration-300"
        role="button" tabindex="0"
        aria-label="{{ $title }}" title="{{ $title }}">

        <x-icon name="{{ $icon }}" size="5"
            class="transition-transform duration-300 group-hover:-translate-y-1 " />
    </a>
</div>
