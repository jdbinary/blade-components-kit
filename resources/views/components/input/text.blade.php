@props([
    'id' => null,
    'name' => '',
    'label' => '',
    'placeholder' => 'Write text',
    'color' => 'default',
    'width' => 'xl',
    'value' => '',
    'helperText' => '',
    'errorText' => '',
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
        'sm' => 'w-24',
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

<div class="{{ $widthClass }}">
    @if ($label)
        <label for="{{ $inputId }}" class="block font-semibold text-gray-700 dark:text-gray-300">
            {{ $label }}
        </label>
    @endif

    <div class="relative">
        <input type="text" id="{{ $inputId }}" name="{{ $inputName }}" placeholder="{{ $placeholder }}"
            value="{{ $inputValue }}" aria-label="{{ $label ?: $placeholder }}"
            aria-invalid="{{ $hasError ? 'true' : 'false' }}"
            aria-describedby="{{ $hasError ? 'error-' . $inputId : null }}"
            {{ $attributes->merge([
                'class' =>
                    "px-2 py-2 pr-7 my-1 rounded-lg transition-all duration-300 ease-in-out transform $styles $widthClass " .
                    ($hasError ? '  ring-red-500 focus:ring-red-400 border border-red-300' : ''),
            ]) }} />

        @if ($hasError)
            <div class="absolute right-2 top-2 text-red-500 pointer-events-none">
                <x-icon name="alert-circle" class="w-5 h-5" />
            </div>
        @endif
    </div>

    @if ($helperText && !$hasError)
        <p id="helper-{{ $inputId }}" class="text-sm mb-2 text-gray-500 dark:text-gray-400">
            {{ $helperText }}
        </p>
    @endif

    @if ($errorText)
        <p id="error-{{ $inputId }}" class="text-sm text-red-500" role="alert">
            {{ $errorText }}
        </p>
    @elseif ($errors->has($inputName))
        <p id="error-{{ $inputId }}" class="mt-1 text-sm text-red-500" role="alert">
            {{ $errors->first($inputName) }}
        </p>
    @endif
</div>
