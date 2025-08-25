@props([
    'type' => 'info',
    'message' => null,
    'iconClose' => true,
    'timeout' => 5000,
    'position' => 'top-right', // top-right, top-left, bottom-right, bottom-left
    'event' => 'notify', // Event that triggers the toast
    'buttonLabel' => null, // if null, only icon
    'buttonType' => null, // button type for the button, default is 'button'
    'icon' => 'link', // icon to display if there is no label
    'showButton' => true, // If true, show the button with label, otherwise just icon
    'color' => 'success', // Color for the button
    'btnColor' => 'primary', // Color for the button
])

@php
    $colorStyles = [
        'success' => 'bg-green-500 text-white dark:bg-green-600',
        'error' => 'bg-red-500 text-white dark:bg-red-600',
        'warning' => 'bg-yellow-500 text-black dark:bg-yellow-600 dark:text-white',
        'info' => 'bg-primary-500 text-white dark:bg-primary-600',
        'default' => 'bg-gray-500 text-white dark:bg-gray-600',
    ];

    $positionStyles = [
        'top-right' => 'top-4 right-4',
        'top-left' => 'top-4 left-4',
        'bottom-right' => 'bottom-4 right-4',
        'bottom-left' => 'bottom-4 left-4',
    ];

    $color = $colorStyles[$color] ?? $colorStyles['default'];
    $placement = $positionStyles[$position] ?? $positionStyles['top-right'];
    $content = $message ?: $slot;
@endphp

<div x-data>
    @if ($showButton)
        {{-- Show button if there is a label, otherwise only an icon --}}
        @if ($buttonLabel)
            <x-button x-on:click="$dispatch('{{ $event }}')" type="{{ $buttonType }}" color="{{ $btnColor }}">
                {{ $buttonLabel }}
            </x-button>
        @else
            <button x-on:click="$dispatch('{{ $event }}')" type="{{ $buttonType }}" color="{{ $btnColor }}" class="p-2 rounded-full transition cursor-pointer">
                <x-icon name="{{ $icon }}" size="6" />
            </button>
        @endif
    @endif

    {{-- Toast --}}
    <div x-data="{ show: false }" x-show="show"
        x-on:{{ $event }}.window="show = true; setTimeout(() => show = false, {{ $timeout }})"
        x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-2"
        x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 translate-y-2"
        class="fixed {{ $placement }} z-100 max-w-sm w-full {{ $color }} px-4 py-3 rounded-lg shadow-lg flex items-center justify-between gap-3"
        style="display: none;">
        <p class="flex-1 text-sm font-medium">
            {{ $content }}
        </p>

        @if ($iconClose)
            <x-button type="button" x-on:click="show = false" color="none" class="shrink-0 text-white"
                color="none">
                <x-icon name="close" size="6" />
            </x-button>
        @endif
    </div>
</div>
