@props([
    'id' => null,
    'name' => '',
    'label' => '',
    'placeholder' => 'Selecciona una opción',
    'options' => [],
    'color' => 'default',
    'width' => null,
    'value' => '',
    'helperText' => '',
    'errorText' => '',
])

@php
    use Illuminate\Support\Str;

    $colorStyles = [
        'primary' =>
            'bg-primary-100 text-primary-950 placeholder:text-primary-600 dark:bg-primary-900 dark:text-primary-100 focus:ring-primary-500 focus:ring-1 focus:outline-none border border-primary-300',
        'secondary' =>
            'bg-secondary-100 text-secondary-950 placeholder:text-secondary-600 dark:bg-secondary-900 dark:text-secondary-100 focus:ring-secondary-500 focus:ring-1 focus:outline-none border border-secondary-300',
        'success' =>
            'bg-green-100 text-green-950 placeholder:text-green-600 dark:bg-green-900 dark:text-green-100 focus:ring-green-500 focus:ring-1 focus:outline-none border border-green-300',
        'warning' =>
            'bg-yellow-100 text-yellow-950 placeholder:text-yellow-600 dark:bg-yellow-900 dark:text-yellow-100 focus:ring-yellow-500 focus:ring-1 focus:outline-none border border-yellow-300',
        'danger' =>
            'bg-red-100 text-red-950 placeholder:text-red-600 dark:bg-red-900 dark:text-red-100 focus:ring-red-500 focus:ring-1 focus:outline-none border border-red-300',
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

    {{-- Visible label--}}
    @if ($label)
        <label for="{{ $inputId }}" class="block font-semibold text-gray-700 dark:text-white">
            {{ $label }}
        </label>
    @else
        {{-- Hidden label --}}
        <label for="{{ $inputId }}" class="sr-only">
            {{ $placeholder }}
        </label>
    @endif

    <div class="relative">
        <select id="{{ $inputId }}" name="{{ $inputName }}" aria-invalid="{{ $hasError ? 'true' : 'false' }}"
            @if ($hasError) aria-describedby="error-{{ $inputId }}" @endif
            {{ $attributes->merge([
                'class' =>
                    "appearance-none px-4 py-2 pr-7 my-1 rounded-lg transition-all duration-300 ease-in-out transform $styles $widthClass " .
                    ($hasError ? ' ring-red-500 focus:ring-red-400' : ''),
            ]) }}>

            <option disabled {{ $inputValue ? '' : 'selected' }}>{{ $placeholder }}</option>

            @foreach ($options as $key => $display)
                <option value="{{ $key }}"
                    {{ is_array($inputValue)
                        ? (in_array((string) $key, $inputValue)
                            ? 'selected'
                            : '')
                        : ((string) $inputValue === (string) $key
                            ? 'selected'
                            : '') }}>
                    {{ $display }}
                </option>
            @endforeach

        </select>

        {{-- Icon arrow --}}
        <div class="pointer-events-none absolute inset-y-0 right-8 flex items-center text-gray-500 dark:text-gray-300 ">
            <x-icon name="arrow-down-2-fill" />
        </div>

        {{-- Icon error --}}
        @if ($hasError)
            <div class="absolute right-2 top-2 text-red-500 pointer-events-none">
                <x-icon name="alert-circle" class="w-5 h-5" />
            </div>
        @endif
    </div>


    {{-- Helper text --}}
    @if ($helperText && !$hasError)
        <p id="helper-{{ $inputId }}" class="text-sm mb-2 text-gray-500 dark:text-gray-400">
            {{ $helperText }}
        </p>
    @endif

    {{-- Error text --}}
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
