@props([
    'width' => 'w-50', // Width of the dropdown
    'align' => 'right', // left | right
    'spanLabel' => null,
])

<div x-data="{ isOpen: true }" x-init="isOpen = false">
    <div x-data="{ isOpen: false }">
        {{-- Trigger --}}
        <span x-on:click="isOpen = !isOpen"
            class="flex h-8 w-8 items-center justify-center rounded-full bg-primary-200 dark:bg-primary-700 text-primary-900 dark:text-white text-sm font-semibold cursor-pointer hover:scale-102">
            {{ $spanLabel }}
        </span>

        {{-- Menu --}}
        <div  x-cloak x-show="isOpen"  x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-90" @click.away="isOpen = false"
            class="absolute z-20 rounded-lg  right-7 w-50 bg-primary-200 dark:bg-primary-700 text-primary-900 dark:text-white shadow-xl ring-opacity-5 focus:outline-none overflow-hidden">
            {{ $slot }}
        </div>
    </div>
</div>
