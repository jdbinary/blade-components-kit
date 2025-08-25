@props([
    'type' => 'button',
    'label' => 'Button',
    'color' => 'default',
    'size' => 'default',
    'width' => 'xs',
    'icon' => null,
    'iconPosition' => 'left', // left o right
    'iconSize' => '6',
    'iconButton' => null,
    'ariaLabel' => null,
    'title' => null,
    'disabled' => false,
    'shape' => 'rounded',
])

@php
    $disabledColor = $disabled ? 'gray' : $color;

    $colorClass = match ($disabledColor) {
        'none'
            => 'text-gray-800 dark:text-white dark:hover:text-white hover:scale-105',
        'soft-success'
            => 'bg-green-200 hover:bg-green-300 text-green-950 dark:bg-green-300 dark:hover:bg-green-400 dark:text-green-950',
        'soft-primary'
            => 'bg-primary-200 hover:bg-primary-300 text-primary-950 dark:bg-primary-300 dark:hover:bg-primary-400 dark:text-primary-950',
        'soft-secondary'
            => 'bg-secondary-200 hover:bg-secondary-300 text-secondary-950 dark:bg-secondary-300 dark:hover:bg-secondary-400 dark:text-secondary-950',
        'soft-warning'
            => 'bg-yellow-200 hover:bg-yellow-300 text-yellow-950 dark:bg-yellow-300 dark:hover:bg-yellow-400 dark:text-yellow-950',
        'soft-danger'
            => 'bg-red-200 hover:bg-red-300 text-red-950 dark:bg-red-300 dark:hover:bg-red-400 dark:text-red-950',
        'primary'
            => 'bg-primary-500 hover:bg-primary-600 text-primary-950 dark:bg-primary-700 dark:hover:bg-primary-800 dark:text-white',
        'secondary'
            => 'bg-secondary-500 hover:bg-secondary-600 text-secondary-950 dark:bg-secondary-700 dark:hover:bg-secondary-800 dark:text-white',
        'success'
            => 'bg-green-500 hover:bg-green-600 text-green-950 dark:text-white dark:bg-green-700 dark:hover:bg-green-800',
        'warning'
            => 'bg-yellow-500 hover:bg-yellow-600 dark:hover:bg-yellow-800 text-yellow-950 hover:text-white dark:bg-yellow-700 dark:hover:bg-yellow-400 dark:text-white',
        'danger'
            => 'bg-red-500 hover:bg-red-600 dark:hover:bg-red-800 text-red-950 hover:text-white dark:bg-red-700 dark:hover:bg-red-400 dark:text-white',
        'gray' => 'bg-gray-300 text-gray-800 dark:bg-gray-600 dark:text-white',
        default
            => 'bg-gray-500 hover:bg-gray-700 text-gray-800 hover:text-white dark:bg-gray-400 dark:hover:bg-gray-700 dark:text-gray-900 dark:hover:text-white',
    };

    $sizeClass = match ($size) {
        'xs' => 'px-2 py-1 text-xs',
        'sm' => 'px-3 py-1 text-sm',
        'md' => 'px-4 py-1 text-md',
        'lg' => 'px-5 py-1 text-lg',
        'xl' => 'px-6 py-1 text-xl',
        default => 'px-4 py-1 text-md',
    };

    $widthClass = match ($width) {
        'full' => 'w-full',
        'auto' => 'w-auto',
        'sm' => 'w-24',
        'md' => 'w-36',
        'lg' => 'w-48',
        'xl' => 'w-64',
        default => 'w-auto',
    };

    $shapeClass = match ($shape) {
        'square' => 'rounded-none',
        'rounded' => 'rounded-lg',
        'rounded-full' => 'rounded-full',
        default => 'rounded-lg',
    };

    $accessibleLabel = $ariaLabel ?? $label;
    $disabledClass = $disabled ? 'opacity-50 cursor-not-allowed pointer-events-none' : '';
@endphp

<button type="{{ $type }}" @if ($accessibleLabel) aria-label="{{ $accessibleLabel }}" @endif
    @if ($title) title="{{ $title }}" @endif
    @if ($disabled) disabled @endif
    {{ $attributes->merge([
        'class' => "flex items-center cursor-pointer justify-center  font-semibold {$colorClass} {$sizeClass} {$widthClass} {$shapeClass} {$disabledClass} transition duration-200 ease-in-out",
    ]) }}>
    {{-- Icon left --}}
    @if ($icon && $iconPosition === 'left')
        <x-icon name="{{ $icon }}" size="{{ $iconSize }}" />
    @endif

    {{-- Content --}}
    @if ($slot->isNotEmpty())
        {{ $slot }}
    @else
        <span>{{ $label }}</span>
    @endif

    {{-- Icon right --}}
    @if ($icon && $iconPosition === 'right')
        <x-icon name="{{ $icon }}" size="{{ $iconSize }}" />
    @endif
</button>
