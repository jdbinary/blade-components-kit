@props([
    'id' => null,
    'name' => '',
    'label' => '',
    'placeholder' => 'Search element...',
    'color' => 'default',
    'width' => 'xl',
    'value' => '',
    'icon' => true,
    'iconOnly' => false,
    'helperText' => '',
    'errorText' => '',
    'dropdown' => false,
    'items' => [],
    'noResults' => 'No results found.',
])

@php

    $colorStyles = [
        'none' => 'bg-transparent text-inherit',
        'primary' =>
            'bg-white text-primary-950 placeholder:text-primary-600 dark:bg-neutral-800 dark:text-primary-100 focus:ring-primary-500 focus:ring-1 focus:outline-none border border-primary-300',
        'secondary' =>
            'bg-white text-secondary-950 placeholder:text-secondary-600 dark:bg-neutral-800 dark:text-secondary-100 focus:ring-secondary-500 focus:ring-1 focus:outline-none border border-secondary-300',
        'success' =>
            'bg-white text-green-950 placeholder:text-green-600 dark:bg-neutral-800 dark:text-green-100 focus:ring-green-500 focus:ring-1 focus:outline-none border border-green-300',
        'warning' =>
            'bg-white text-yellow-950 placeholder:text-yellow-600 dark:bg-neutral-800 dark:text-yellow-100 focus:ring-yellow-500 focus:ring-1 focus:outline-none border border-yellow-300',
        'danger' =>
            'bg-white text-red-950 placeholder:text-red-600 dark:bg-neutral-800 dark:text-red-100 focus:ring-red-500 focus:ring-1 focus:outline-none border border-red-300',
        'default' =>
            'bg-white text-gray-900 placeholder:text-gray-600 dark:placeholder:text-gray-300 dark:bg-neutral-800 dark:text-white focus:ring-gray-500 focus:ring-1 focus:outline-none border border-gray-300 dark:border-neutral-700 shadow',
    ];
    $widthClass = match ($width) {
        'full' => 'w-full',
        'auto' => 'w-auto',
        'md' => 'w-36',
        'lg' => 'w-48',
        'xl' => 'w-64',
        default => 'w-full',
    };

    $inputId = $id ?: 'input-' . str_pad(mt_rand(0, 9999), 4, '0', STR_PAD_LEFT);
    $styles = $colorStyles[$color] ?? $colorStyles['default'];
    $inputName = $name ?: $inputId;
    $inputValue = old($inputName, $value);
    $hasError = $errors->has($inputName) || $errorText;
@endphp

<div class="{{ $widthClass }} relative"
    @if ($dropdown) x-data="{
            search: '{{ $inputValue }}',
            open: false,
            isMac: navigator.platform.toUpperCase().includes('MAC'),
            isMobile: /Mobi|Android/i.test(navigator.userAgent),
            init() {
                window.addEventListener('keydown', (e) => {
                    if ((e.ctrlKey || e.metaKey) && e.key === 'k') {
                        e.preventDefault();
                        this.open = true;
                        $nextTick(() => $refs.input.focus());
                    }
                });
            },
            get filteredItems() {
                return {{ Js::from($items) }}.filter(i => i.toLowerCase().includes(this.search.toLowerCase()));
            }
        }"
        x-init="init"
        x-on:click.away="open = false" @endif>
    @if ($label)
        <label for="{{ $inputId }}" class="block mb-1 font-semibold text-gray-700 dark:text-gray-300">
            {{ $label }}
        </label>
    @endif

    <div class="relative">
        <input type="search" x-ref="input" id="{{ $inputId }}" name="{{ $inputName }}"
            placeholder="{{ $placeholder }}"
            @if ($dropdown) x-model="search"
        x-on:focus="open = true"
        x-on:input="open = true" @endif
            value="{{ $inputValue }}" aria-label="{{ $label ?: $placeholder }}"
            aria-invalid="{{ $hasError ? 'true' : 'false' }}"
            aria-describedby="{{ $hasError ? 'error-' . $inputId : null }}"
            {{ $attributes->merge([
                'class' =>
                    "px-4 py-2 pr-10 my-1 rounded-lg transition-all duration-300 ease-in-out transform $styles $widthClass " .
                    ($hasError ? 'ring-red-500 focus:ring-red-400 border border-red-300' : ''),
            ]) }} />
        @if ($icon && $dropdown)
            <div
                class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-500 dark:text-gray-400 text-xs font-mono space-x-1/2">
                <!-- Desktop only -->
                <template x-if="!isMobile">
                    <span x-show="isMac">
                        <kbd
                            class="bg-gray-200 dark:bg-neutral-700 text-gray-800 dark:text-gray-200 px-1 rounded">⌘</kbd>
                        +
                        <kbd
                            class="bg-gray-200 dark:bg-neutral-700 text-gray-800 dark:text-gray-200 px-1 rounded">K</kbd>
                    </span>
                </template>

                <template x-if="!isMobile">
                    <span x-show="!isMac">
                        <kbd
                            class="bg-gray-200 dark:bg-neutral-700 text-gray-800 dark:text-gray-200 px-1 rounded">Ctrl</kbd>
                        +
                        <kbd
                            class="bg-gray-200 dark:bg-neutral-700 text-gray-800 dark:text-gray-200 px-1 rounded">K</kbd>
                    </span>
                </template>

                <!-- Mobile -->
                <template x-if="isMobile">
                    <x-icon name="search" class="w-4 h-4" />
                </template>
            </div>
        @elseif ($icon)
            <div class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-500 dark:text-gray-400">
                <x-icon name="search" class="w-4 h-4" />
            </div>
        @endif
    </div>

    {{-- Dropdown --}}
    @if ($dropdown)
        <ul x-show="open && filteredItems.length" x-transition
            class="absolute left-0 right-0 z-10 mt-1 bg-white dark:bg-neutral-800 border border-gray-300 dark:border-neutral-700 rounded-md shadow-lg max-h-60 overflow-auto w-full">
            <template x-for="item in filteredItems" :key="item">
                <li x-text="item" x-on:click="search = item; open = false"
                    class="px-4 py-2 text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-neutral-700 cursor-pointer">
                </li>
            </template>
        </ul>

        <div x-show="open && !filteredItems.length" x-transition
            class="absolute left-0 right-0 z-10 mt-1 bg-white dark:bg-neutral-800 border border-gray-300 dark:border-neutral-700 rounded-md px-4 py-2 text-gray-500 dark:text-gray-400 w-full">
            {{ $noResults }}
        </div>
    @endif


    @if ($helperText && !$hasError)
        <p id="helper-{{ $inputId }}" class="text-sm mb-2 text-gray-500 dark:text-gray-400">
            {{ $helperText }}
        </p>
    @endif
</div>
