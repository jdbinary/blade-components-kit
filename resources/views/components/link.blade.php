@props([
    'href' => '#',
    'label' => 'link',
    'bgColor' => 'default',
    'color' => 'default',
    'size' => 'md',
    'width' => 'auto',
    'icon' => null,
    'iconHover' => 'false',
    'iconSize' => '4',
    'iconLink' => null,
    'scale' => false,
    'iconPosition' => 'right',
    'ariaLabel' => null,
    'title' => null,
    'target' => null,
    'rel' => 'noopener noreferrer',
    'shape' => 'rounded',
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
            => 'bg-yellow-500 hover:bg-yellow-600 dark:hover:bg-yellow-800 text-yellow-950  dark:bg-yellow-700 dark:hover:bg-yellow-400 dark:text-white',
        'danger'
            => 'bg-red-500 hover:bg-red-600 dark:hover:bg-red-800 text-red-950 dark:bg-red-700 dark:hover:bg-red-400 dark:text-white',

        'gray' => 'bg-gray-500 hover:bg-gray-600 dark:bg-gray-600 text-white dark:text-white',
        default => 'text-gray-800 hover:text-white  dark:text-gray-900 dark:hover:text-white',
    };

    $colorClass = match ($color) {
        'primary' => 'text-primary-700 dark:text-primary-200 hover:text-primary-900 dark:hover:text-white',
        'secondary' => 'text-secondary-700 dark:text-secondary-300 hover:text-secondary-900 dark:hover:text-white',
        'success' => 'text-green-700 dark:text-green-300 hover:text-green-900 dark:hover:text-white',
        'warning' => 'text-yellow-700 dark:text-yellow-300 hover:text-yellow-900 dark:hover:text-white',
        'danger' => 'text-red-700 dark:text-red-300 hover:text-red-900 dark:hover:text-white',
        default => 'text-gray-700 dark:text-gray-300 dark:hover:text-white hover:text-gray-900',
    };

    $sizeClass = match ($size) {
        'xs' => 'px-2 py-1 text-xs',
        'sm' => 'px-3 py-1 text-sm',
        'md' => 'px-4 py-1 text-base',
        'lg' => 'px-5 py-1 text-lg',
        'xl' => 'px-6 py-1 text-xl',
        default => 'px-4 py-1 text-base',
    };

    $widthClass = match ($width) {
        'full' => 'w-full',
        'auto' => 'w-auto',
        'sm' => 'w-24',
        'md' => 'w-36',
        'lg' => 'w-48',
        default => 'w-auto',
    };

    $iconClass = $iconHover === 'true' ? 'transition-transform duration-300 ease-in-out group-hover:translate-x-1' : '';

    $shapeClass = match ($shape) {
        'square' => 'rounded-none',
        'rounded' => 'rounded-lg',
        'rounded-full' => 'rounded-full',
        default => 'rounded-lg',
    };

    $accessibleLabel = $ariaLabel ?? $label;

    $scaleClass = $scale ? 'hover:scale-105 transition duration-200 ease-in-out' : '';
@endphp

<a href="{{ $href }}"
    {{ $attributes->merge([
        'class' => collect([
            'inline-flex items-center gap-1 font-semibold group transition duration-300 ease-in-out',
            $sizeClass,
            $widthClass,
            $scaleClass,
            $bgColor !== 'default' ? $bgColorClass : $colorClass,
            $bgColor !== 'default' ? $shapeClass : null,
        ])->filter()->implode(' '),
    ]) }}
    @if ($accessibleLabel) aria-label="{{ $accessibleLabel }}" @endif
    @if ($title) title="{{ $title }}" @endif
    @if ($target) target="{{ $target }}" @endif
    @if ($rel) rel="{{ $rel }}" @endif>


    @if ($icon && $iconPosition === 'left')
        <x-icon name="{{ $icon }}" size="{{ $iconSize }}" class="{{ $iconClass }}" />
    @endif

    @if (!$iconLink)
        @if (trim($slot) !== '')
            {{ $slot }}
        @elseif ($label)
            <span>{{ $label }}</span>
        @endif
    @endif



    @if ($icon && $iconPosition === 'right')
        <x-icon name="{{ $icon }}" size="{{ $iconSize }}" class="{{ $iconClass }}" />
    @endif
</a>
