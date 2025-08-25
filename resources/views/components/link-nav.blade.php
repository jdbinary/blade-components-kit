@props([
    'href' => null,
    'label' => null,
    'icon' => null,
    'iconPosition' => 'right',
    'size' => 'md',
    'color' => null,
    'count' => null,
    'active' => false, // Active status
])

@php
  
    $colorClass = match ($color) {
        'none' => 'bg-transparent hover:text-gray-300 dark:hover:text-gray-300 dark:text-white',
        'primary' => 'text-primary-800 dark:text-primary-200 hover:text-primary-900 dark:hover:text-white',
        'secondary' => 'text-secondary-800 dark:text-secondary-200 hover:text-secondary-900 dark:hover:text-white',
        'success' => 'text-green-800 dark:text-green-100 hover:text-green-900 dark:hover:text-white',
        'warning' => 'text-yellow-800 dark:text-yellow-100 hover:text-yellow-900 dark:hover:text-white',
        'danger' => 'text-red-800 dark:text-red-300 hover:text-red-900 dark:hover:text-white',
        default => 'text-primary-950 hover:text-primary-900 dark:text-primary-100 dark:hover:text-white',
    };

   
    $activeClass = $active
        ? 'font-medium bg-primary-200/80 border-b rounded-md dark:bg-primary-950/80'
        : '';


    $sizeClass = match ($size) {
        'xs' => 'px-2 py-1 text-xs',
        'sm' => 'text-sm py-1',
        'md' => 'text-md py-0.5',
        'lg' => 'text-lg py-3',
        default => 'text-sm py-0.5',
    };

    $countBgClass = match ($color) {
        'primary' => 'bg-primary-950 text-primary-900 dark:bg-primary-950 dark:text-primary-100',
        'secondary' => 'bg-secondary-950 text-secondary-900 dark:bg-secondary-400 dark:text-secondary-100',
        'success' => 'bg-green-500 text-green-900 dark:bg-green-400 dark:text-green-100',
        'warning' => 'bg-yellow-500 text-yellow-900 dark:bg-yellow-400 dark:text-yellow-100',
        'danger' => 'bg-red-500 text-red-900 dark:bg-red-400 dark:text-red-100',
        default => 'bg-primary-50 text-primary-950 dark:bg-primary-900 dark:text-primary-50',
    };

    $isButtonRole = $attributes->get('role') === 'button';
    $extraClasses = $isButtonRole ? 'cursor-pointer' : '';
@endphp

<a 
    @unless($isButtonRole)
        href="{{ $href }}"
    @endunless
    {{ $attributes->merge([
        'class' => "group flex items-center gap-2 px-2 {$sizeClass} {$colorClass} {$activeClass} {$extraClasses}"
    ]) }}
>
    {{-- Icon left --}}
    @if ($icon && $iconPosition === 'left')
        <span class="flex flex-none items-center">
            <x-icon :name="$icon" />
        </span>
    @endif

    {{-- Content --}}
    <span class="grow py-1">
        {{ $label ?? $slot }}
    </span>

    {{-- Icon right --}}
    @if ($icon && $iconPosition === 'right')
        <span class="flex flex-none items-center">
            <x-icon :name="$icon" />
        </span>
    @endif

    {{-- Count badge --}}
    @if ($count)
        <span class="rounded-full px-2 py-1 text-xs leading-4 font-medium transition {{ $countBgClass }}">
            {{ $count }}
        </span>
    @endif
</a>
