@props([
    'id' => null,
    'name' => '',
    'label' => null,
    'placeholder' => 'Write email...',
    'color' => 'default',
    'width' => 'xl',
    'value' => '',
    'ariaLabel' => null,
    'icon' => false,
    'helperText' => '',
    'autocomplete' => null,
    'autofocus' => false,
])

@php
    $colorStyles = [
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
@endphp

<div class="{{ $widthClass }}">
    {{-- Label --}}
    @if ($label)
        <label for="{{ $inputId }}" class="block font-semibold text-gray-700 dark:text-gray-300">
            {{ $label }}
        </label>
    @endif

    <div class="relative">
        {{-- Input --}}
        <input 
            id="{{ $inputId }}" 
            name="{{ $inputName }}" 
            placeholder="{{ $placeholder }}"
            value="{{ $inputValue }}" 
            aria-label="{{ $ariaLabel ?: $label ?: $placeholder }}"
            @if ($autocomplete) autocomplete="{{ $autocomplete }}" @endif
            @if ($autofocus) autofocus @endif
            {{ $attributes->merge([
                'class' => "px-4 py-2 pr-10 my-1 rounded-lg transition-all duration-300 ease-in-out transform $styles $widthClass " . ($errors->has($inputName) ? 'ring-red-500 focus:ring-red-400 border border-red-300' : ''),
            ]) }}
        />

        {{-- Ícon email --}}
        @if ($icon)
            <div class="absolute inset-y-0 {{ $errors->has($inputName) ? 'right-8' : 'right-4' }} flex items-center text-gray-500 dark:text-gray-400">
                <x-icon name="mail" class="w-4 h-4" />
            </div>
        @endif

        {{-- Ícon error --}}
        @error($inputName)
            <div class="absolute right-2 top-2 text-red-500 pointer-events-none">
                <x-icon name="alert-circle" class="w-5 h-5" />
            </div>
        @enderror
    </div>

    {{-- Helper text --}}
    @if ($helperText && !$errors->has($inputName))
        <p id="helper-{{ $inputId }}" class="text-sm mb-2 text-gray-500 dark:text-gray-400">
            {{ $helperText }}
        </p>
    @endif

    {{-- Error text --}}
    @error($inputName)
        <p id="error-{{ $inputId }}" class="mt-1 text-sm text-red-500" role="alert">
            {{ $message }}
        </p>
    @enderror
</div>
