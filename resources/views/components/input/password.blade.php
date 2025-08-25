@props([
    'id' => null,
    'name' => '',
    'label' => null,
    'placeholder' => 'Your password',
    'color' => 'default',
    'width' => 'xl',
    'value' => '',
    'ariaLabel' => null,
    'icon' => false,
    'helperText' => '',
])

@php

    //  Color styles
    $colorStyles = [
        'primary' => 'bg-white text-primary-950 placeholder:text-primary-600 dark:bg-neutral-800 dark:text-primary-100 focus:ring-primary-500 focus:ring-1 focus:outline-none border border-primary-300',
        'secondary' => 'bg-white text-secondary-950 placeholder:text-secondary-600 dark:bg-neutral-800 dark:text-secondary-100 focus:ring-secondary-500 focus:ring-1 focus:outline-none border border-secondary-300',
        'success' => 'bg-white text-green-950 placeholder:text-green-600 dark:bg-neutral-800 dark:text-green-100 focus:ring-green-500 focus:ring-1 focus:outline-none border border-green-300',
        'warning' => 'bg-white text-yellow-950 placeholder:text-yellow-600 dark:bg-neutral-800 dark:text-yellow-100 focus:ring-yellow-500 focus:ring-1 focus:outline-none border border-yellow-300',
        'danger' => 'bg-white text-red-950 placeholder:text-red-600 dark:bg-neutral-800 dark:text-red-100 focus:ring-red-500 focus:ring-1 focus:outline-none border border-red-300',
        'default' => 'bg-white text-gray-900 placeholder:text-gray-600 dark:placeholder:text-gray-300 dark:bg-neutral-800 dark:text-white focus:ring-gray-500 focus:ring-1 focus:outline-none border border-gray-300 dark:border-neutral-700 shadow',
    ];

    // Width classes
    $widthClass = match ($width) {
        'full' => 'w-full',
        'auto' => 'w-auto',
        'md'   => 'w-36',
        'lg'   => 'w-48',
        'xl'   => 'w-64',
        default => 'w-full',
    };

    // Identifiers and values
    $inputId = $id ?: 'input-' . str_pad(mt_rand(0, 9999), 4, '0', STR_PAD_LEFT);
    $inputName = $name ?: $inputId;
    $inputValue = old($inputName, $value);

    // Verified if there is a Laravel error
    $hasError = $errors->has($inputName);

    //  Extra Class
    $inputClasses = $colorStyles[$color] ?? $colorStyles['default'];
    if ($hasError) {
        $inputClasses .= ' ring-red-500 focus:ring-red-400 border border-red-300';
    }

    // Position of the password icon
    $passwordIconRightClass = $hasError ? 'right-8' : 'right-4';

    //  ARIA
    $ariaDescribedBy = $hasError
        ? 'error-' . $inputId
        : ($helperText ? 'helper-' . $inputId : null);
@endphp

<div class="{{ $widthClass }}" x-data="{ show: false }">
    {{-- Label --}}
    @if ($label)
        <label for="{{ $inputId }}" class="block mb-1 font-semibold text-gray-700 dark:text-gray-300">
            {{ $label }}
        </label>
    @endif

    {{-- Input con toggle --}}
    <div class="relative flex items-center">
        <input 
            :type="show ? 'text' : 'password'"
            id="{{ $inputId }}"
            name="{{ $inputName }}"
            placeholder="{{ $placeholder }}"
            value="{{ e($inputValue) }}"
            aria-label="{{ $ariaLabel ?: ($label ?: $placeholder) }}"
            aria-invalid="{{ $hasError ? 'true' : 'false' }}"
            @if($ariaDescribedBy) aria-describedby="{{ $ariaDescribedBy }}" @endif
            {{ $attributes->merge(['class' => "px-4 py-2 pr-10 my-1 rounded-lg transition-all duration-300 ease-in-out transform $inputClasses $widthClass"]) }}
        />

        {{--Show/Hide Password Button --}}
        @if ($icon)
            <div class="absolute inset-y-0 {{ $passwordIconRightClass }} flex items-center">
                <button 
                    type="button" 
                    x-on:click="show = !show"
                    class="text-gray-500 dark:text-gray-400 focus:outline-none"
                    title="Mostrar contraseña"
                >
                    <template x-if="!show">
                        <x-icon name="eye-off" size="6" />
                    </template>
                    <template x-if="show">
                        <x-icon name="eye" size="6" />
                    </template>
                </button>
            </div>
        @endif

        {{-- Icon error --}}
        @error($inputName)
            <div class="absolute right-2 top-2 text-red-500 pointer-events-none">
                <x-icon name="alert-circle" class="w-5 h-5" />
            </div>
        @enderror
    </div>

    {{-- Helper text --}}
    @if ($helperText && !$hasError)
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
