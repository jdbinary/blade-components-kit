@props([
    'show' => false,
    'iconButton' => '',
    'contentButton' => '',
    'openLabel' => 'Open Modal',
    'closeLabel' => 'Close',
    'position' => 'center',
    'closeOnClick' => false,
    'title' => '',
    'width' => '5xl',
    'bgColor' => 'primary',
    'color' => 'default',
    'kbdMac' => '',
    'kbdWinLinux' => '',
    'alpineAttributes' => false,
])

@php
    $positionClass = match ($position) {
        'top' => 'items-start mt-10',
        'bottom' => 'items-end mb-10',
        default => 'items-center',
    };

    $widthClass = match ($width) {
        'full' => 'w-full',
        'auto' => 'w-auto',
        'xl' => 'w-64',
        '2xl' => 'w-80',
        '3xl' => 'w-96',
        '4xl' => 'w-112',
        '5xl' => 'w-128',
        '6xl' => 'w-144',
        default => 'w-auto',
    };

    $bgColorClass = match ($bgColor) {
        'none' => 'bg-transparent hover:bg-transparent text-inherit',
        'primary'
            => 'bg-primary-100  text-primary-950 dark:bg-primary-700  dark:text-white',
        'secondary'
            => 'bg-secondary-500 text-secondary-950 dark:bg-secondary-700 dark:text-white',
        'success'
            => 'bg-green-500 text-green-950 dark:text-white dark:bg-green-700',
        'warning'
            => 'bg-yellow-500 text-yellow-950 dark:bg-yellow-700 dark:hover:bg-yellow-400 dark:text-white',
        'danger'
            => 'bg-red-500 text-red-950 dark:bg-red-700 dark:hover:bg-red-400 dark:text-white',
        default
            => 'bg-gray-500  text-gray-950 dark:bg-gray-700 dark:text-white',
    };

    $colorClass = match ($color) {
        'primary' => 'text-primary-700 dark:text-primary-300 hover:text-primary-900 dark:hover:text-white',
        'secondary' => 'text-secondary-700 dark:text-secondary-300 hover:text-secondary-900 dark:hover:text-white',
        'success' => 'text-green-700 dark:text-green-300 hover:text-green-900 dark:hover:text-white',
        'warning' => 'text-yellow-700 dark:text-yellow-300 hover:text-yellow-900 dark:hover:text-white',
        'danger' => 'text-red-700 dark:text-red-900 hover:text-red-900 dark:hover:text-white',
        default => 'text-gray-700 dark:text-gray-300 dark:hover:text-white hover:text-gray-900',
    };

    $modalId = 'modal-' . uniqid();
    $titleId = 'modal-title-' . uniqid();
    $descId = 'modal-desc-' . uniqid();
    $label = $iconButton || $kbdMac || $kbdWinLinux;
@endphp

<style>
    @keyframes shake {

        0%,
        100% {
            transform: translateX(0);
        }

        20%,
        60% {
            transform: translateX(-8px);
        }

        40%,
        80% {
            transform: translateX(8px);
        }
    }

    .animate-shake {
        animation: shake 0.4s ease;
    }
</style>

<div x-data="{
    open: {{ $show ? 'true' : 'false' }},
    animateOut: false,
    handleOutsideClick() {
        if ({{ $closeOnClick ? 'true' : 'false' }}) {
            this.open = false;
        } else {
            this.animateOut = true;
            setTimeout(() => this.animateOut = false, 400);
        }
    }
}">
    <!-- Trigger Button -->
    <x-button x-on:click="open = true" class="{{ $colorClass }}"
        @keydown.window="($event.key === 'b' && ($event.metaKey || $event.ctrlKey)) ? open = true : null"
        color="none" size="md" width="auto" x-bind:aria-expanded="open.toString()"
        aria-haspopup="dialog" aria-controls="{{ $modalId }}">
        @if ($label)
            <div class="flex items-center gap-1">
                @if ($iconButton)
                    <x-icon name="{{ $iconButton }}" size="8" />
                @endif
                @if ($kbdMac || $kbdWinLinux)
                    <div class="hidden md:flex items-center">
                        @if ($kbdMac)
                            <kbd class="hidden [.os-macos_&]:inline-flex text-sm">{{ $kbdMac }}</kbd>
                        @endif
                        @if ($kbdWinLinux)
                            <kbd class="hidden not-[.os-macos_&]:inline-flex text-sm">{{ $kbdWinLinux }}</kbd>
                        @endif
                    </div>
                @endif
            </div>
        @else
            {{ $openLabel }}
        @endif
    </x-button>

    <!-- Overlay -->
    <div x-show="open" x-cloak x-transition.opacity class="fixed inset-0 bg-primary-500/25 z-99" aria-hidden="true">
    </div>

    <!-- Modal Window -->
    <div x-show="open" x-cloak x-show="isOpen"  x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-90" class="fixed inset-0 flex justify-center z-100 {{ $positionClass }}"
        @keydown.escape.window="open = false" role="dialog" aria-modal="true" aria-labelledby="{{ $titleId }}"
        aria-describedby="{{ $descId }}" id="{{ $modalId }}">
        <div class="{{ $bgColorClass }} p-6 rounded-xl shadow mx-1 {{ $widthClass }} relative"
            x-bind:class="{ 'animate-shake': animateOut }" @click.outside="handleOutsideClick">

            <!-- Close Button -->
            <div class="absolute top-3 right-3 ">
                <span x-on:click="open = false" class="cursor-pointer">
                    <x-icon name="close"  />
                </span>
            </div>

            <!-- Title -->
            <div class="mb-2">
                <h2 id="{{ $titleId }}" class="text-xl font-semibold">
                    {{ $title }}
                </h2>
            </div>

            <!-- Content Slot -->
            <div id="{{ $descId }}">
                {{ $slot }}
            </div>

            <!-- Close Footer Button -->
            <div class="mt-4 text-right">
                <x-button x-on:click="open = false" size="sm"
                    class="bg-gray-200 rounded"
                    label="{{ $closeLabel }}" />
            </div>
        </div>
    </div>
</div>
