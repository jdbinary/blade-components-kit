@props([
    'id' => 'datetime-' . \Illuminate\Support\Str::random(6),
    'name' => '',
    'label' => '',
    'placeholder' => '',
    'color' => 'default',
    'width' => 'md',
    'value' => '',
    'helperText' => '',
    'time' => true,
    'icon' => 'calendar',
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
        'md' => 'w-64',
        'sm' => 'w-40',
        'auto' => 'w-auto',
        default => 'w-full',
    };

    $styles = $colorStyles[$color] ?? $colorStyles['default'];
    $inputName = $name ?: $id;
    $inputType = $time ? 'datetime-local' : 'date';
@endphp

<div class="{{ $widthClass }} space-y-2">

    @if ($label)
        <label for="{{ $id }}" class="block mb-1 font-semibold text-gray-700 dark:text-gray-300">
            {{ $label }}
        </label>
    @endif

    <div class="relative flex items-center">

        <input type="{{ $inputType }}" id="{{ $id }}" name="{{ $inputName }}"
            value="{{ old($inputName, $value) }}" placeholder="{{ $placeholder }}"
            @if (!$label) aria-label="{{ $placeholder ?: 'Selector de fecha y hora' }}" @endif
            aria-invalid="{{ $errors->has($inputName) ? 'true' : 'false' }}"
            @if ($errors->has($inputName)) aria-describedby="error-{{ $id }}" @endif
            {{ $attributes->merge([
                'class' =>
                    "px-4 py-2 pr-10 rounded-lg transition-all duration-300 ease-in-out transform focus:shadow-lg focus:outline-none $widthClass $styles appearance-none" . ($errors->has($inputName) ? ' ring-red-500 focus:ring-red-400 border-red-500' : ''),
            ]) }} />

        @if ($icon)
            <button type="button"
                class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-500 dark:text-gray-400"
                onclick="document.getElementById('{{ $id }}').showPicker()"
                aria-label="Abrir selector de fecha y hora">
                <x-icon :name="$icon" class="w-4 h-4" title="Seleccionar fecha y hora" />
            </button>
        @endif

    </div>

    @if ($helperText)
        <p class="text-sm text-gray-500 dark:text-gray-400">
            {{ $helperText }}
        </p>
    @endif

    @error($inputName)
        <p id="error-{{ $id }}" class="mt-1 text-sm text-red-500">
            {{ $message }}
        </p>
    @enderror

</div>

<style>
    input[type="date"]::-webkit-calendar-picker-indicator,
    input[type="datetime-local"]::-webkit-calendar-picker-indicator {
        opacity: 0;
        cursor: pointer;
    }
</style>
