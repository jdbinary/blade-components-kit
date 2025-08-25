@props([
    'id' => '',
    'name' => '',
    'label' => '',
    'placeholder' => 'Write here...',
    'rows' => 4,
    'color' => 'default',
    'size' => 'md',
    'width' => 'md',
    'shape' => 'rounded',
    'resize' => true,
    'value' => '',
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

    $sizeClass = match ($size) {
        'sm' => 'text-sm px-3 py-2',
        'lg' => 'text-lg px-5 py-3',
        default => 'text-base px-4 py-2',
    };

    $widthClass = match ($width) {
        'full' => 'w-full',
        'md' => 'w-64',
        'sm' => 'w-40',
        'auto' => 'w-auto',
        default => 'w-full',
    };

    $shapeClass = $shape === 'square' ? '' : 'rounded-md';
    $styles = $colorStyles[$color] ?? $colorStyles['default'];
    $resizeClass = $resize ? 'resize-y' : 'resize-none';
    $textareaId = $id ?: 'textarea-' . uniqid();
    $hasError = $errors->has($name);
@endphp

<div class="{{ $widthClass }} ">

    @if ($label)
        <label for="{{ $textareaId }}" class="block mb-1 font-semibold ">
            {{ $label }}
        </label>
    @else
        <label for="{{ $textareaId }}" class="sr-only">
            {{ $placeholder }}
        </label>
    @endif

    <textarea id="{{ $textareaId }}" name="{{ $name }}" rows="{{ $rows }}" placeholder="{{ $placeholder }}"
        aria-invalid="{{ $hasError ? 'true' : 'false' }}"
        @if ($hasError) aria-describedby="error-{{ $textareaId }}" @endif
        {{ $attributes->merge([
            'class' =>
                "block dark:text-white shadow-sm focus:outline-none transition-all duration-200 ease-in-out $styles $sizeClass $widthClass $shapeClass $resizeClass" .
                ($hasError ? ' ring-red-500 focus:ring-red-400 border border-red-300' : ''),
        ]) }}>{{ old($name, $value) }}</textarea>

    @if ($hasError)
        <p id="error-{{ $textareaId }}" class="mt-1 text-sm text-red-500">{{ $errors->first($name) }}</p>
    @endif

</div>
