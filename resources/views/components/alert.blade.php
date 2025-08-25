@props([
    'on' => null,
    'type' => 'success', // success, error, warning, info, default
    'message' => null,
    'iconClose' => true,
])

@php
    $colorStyles = [
        'success' => 'bg-green-500 text-white dark:bg-green-600 dark:text-green-100',
        'error'   => 'bg-red-500 text-white dark:bg-red-600 dark:text-red-100',
        'warning' => 'bg-yellow-500 text-black dark:bg-yellow-600 dark:text-yellow-100',
        'info'    => 'bg-blue-500 text-white dark:bg-blue-600 dark:text-blue-100',
        'default' => 'bg-gray-500 text-white dark:bg-gray-600 dark:text-gray-100',
    ];

    $textColors = [
        'success' => 'text-white dark:text-green-100',
        'error'   => 'text-white dark:text-red-100',
        'warning' => 'text-black dark:text-yellow-100',
        'info'    => 'text-white dark:text-blue-100',
        'default' => 'text-white dark:text-gray-100',
    ];

    $classes = $colorStyles[$type] ?? $colorStyles['default'];
    $content = $message ?: $slot;
@endphp

<div
    x-data="{ show: false, timeout: null }"
    x-init="
        @if ($on)
            @this.on('{{ $on }}', () => {
                clearTimeout(timeout);
                show = true;
                timeout = setTimeout(() => { show = false }, 4000);
            })
        @else
            show = true
        @endif
    "
    x-show="show"
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0 -translate-y-2"
    x-transition:enter-end="opacity-100 translate-y-0"
    x-transition:leave="transition ease-in duration-300"
    x-transition:leave-start="opacity-100 translate-y-0"
    x-transition:leave-end="opacity-0 -translate-y-2"
    style="display: none;"
    {{ $attributes->merge(['class' => "flex items-center justify-between gap-3 px-3 py-1 rounded-lg shadow-md $classes"]) }}
>
    <p class="flex-1 text-sm font-medium">
        {{ $content }}
    </p>

    @if ($iconClose)
        <button
            type="button"
            x-on:click="show = false"
            class="shrink-0 text-white hover:opacity-75"
        >
            <x-icon name="close" class="w-3 h-3" />
        </button>
    @endif
</div>
