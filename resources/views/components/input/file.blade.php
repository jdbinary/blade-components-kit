@props([
    'id' => null,
    'name' => '',
    'label' => '',
    'accept' => 'image/*',
    'color' => 'default',
    'width' => 'xl',
    'value' => '',
    'helperText' => '',
    'errorText' => '',
    'multiple' => false,
])

@php
    $colorStyles = [
        'primary' =>
            'bg-white text-primary-950 placeholder:text-primary-600 dark:bg-neutral-800 dark:text-primary-100 focus:ring-primary-500 focus:ring-1 focus:outline-none border border-primary-300 dark:border-primary-700 hover:border-primary-500 file:bg-primary-500 file:text-white file:hover:bg-primary-600',
        'secondary' =>
            'bg-white text-secondary-950 placeholder:text-secondary-600 dark:bg-neutral-800 dark:text-secondary-100 focus:ring-secondary-500 focus:ring-1 focus:outline-none border border-secondary-300 dark:border-secondary-700 hover:border-secondary-500 file:bg-secondary-500 file:text-white file:hover:bg-secondary-600',
        'success' =>
            'bg-white text-green-950 placeholder:text-green-600 dark:bg-neutral-800 dark:text-green-100 focus:ring-green-500 focus:ring-1 focus:outline-none border border-green-300 dark:border-green-700 hover:border-green-500 file:bg-green-500 file:text-white file:hover:bg-green-600',
        'warning' =>
            'bg-white text-yellow-950 placeholder:text-yellow-600 dark:bg-neutral-800 dark:text-yellow-100 focus:ring-yellow-500 focus:ring-1 focus:outline-none border border-yellow-300 dark:border-yellow-700 hover:border-yellow-500 file:bg-yellow-500 file:text-white file:hover:bg-yellow-600',
        'danger' =>
            'bg-white text-red-950 placeholder:text-red-600 dark:bg-neutral-800 focus:ring-red-500 focus:ring-1 focus:outline-none border border-red-300 dark:border-red-700 hover:border-red-500 file:bg-red-500 file:text-white file:hover:bg-red-600',
        'default' =>
            'bg-white text-gray-900 placeholder:text-gray-600 dark:placeholder:text-gray-300 dark:bg-neutral-800 file:bg-gray-500 dark:text-white focus:ring-gray-500 focus:ring-1 focus:outline-none border border-gray-300 dark:border-neutral-700',
    ];

    $widthClass = match ($width) {
        'full' => 'w-full',
        'md' => 'w-64',
        'sm' => 'w-40',
        'auto' => 'w-auto',
        default => 'md',
    };

    $inputId = $id ?: 'input-' . str_pad(mt_rand(0, 9999), 4, '0', STR_PAD_LEFT);
    $styles = $colorStyles[$color] ?? $colorStyles['default'];
    $inputName = $name ?: $inputId;
    $inputValue = old($inputName, $value);
    $hasError = $errors->has($inputName) || $errorText;
@endphp

<div class="{{ $widthClass }} space-y-2">

    @if ($label)
        <label for="{{ $id }}" class="block mb-1 font-semibold text-gray-700 dark:text-gray-300">
            {{ $label }}
        </label>
    @endif

    <input id="{{ $id }}" name="{{ $inputName }}{{ $multiple ? '[]' : '' }}" type="file"
        accept="{{ $accept }}" {{ $multiple ? 'multiple' : '' }} aria-label="{{ $label ?: 'Upload file' }}"
        aria-invalid="{{ $hasError ? 'true' : 'false' }}" aria-describedby="{{ $hasError ? 'error-' . $inputId : null }}"
        {{ $attributes->merge([
            'class' =>
                "file:px-4 file:py-1.5 file:rounded-md  file:cursor-pointer file:transition-colors file:duration-200 rounded-lg dark:bg-gray-900 dark:text-white focus:outline-none
                transition-all duration-300 ease-in-out transform focus:shadow-lg $widthClass $styles" . ($hasError ? 'file:bg-red-500 ring-red-500 focus:ring-red-400 border border-red-300 file:text-white' : ''),
        ]) }} />

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
