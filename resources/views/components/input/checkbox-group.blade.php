@props([
    'id' => null,
    'name' => null,
    'label' => '',
    'options' => [
        'example_1' => 'Option 1',
        'example_2' => 'Option 2',
    ],
    'selected' => [],
    'color' => 'default',
    'shape' => 'circle',
    'helperText' => '',
    'errorText' => '',
])

@php
    $colorStyles = [
        'primary' => 'bg-primary-200 dark:bg-primary-950 peer-checked:bg-primary-500 peer-checked:hover:bg-primary-600 peer-checked:text-white dark:peer-checked:bg-primary-600 border border-primary-400',
        'secondary' => 'bg-secondary-200 dark:bg-secondary-950 peer-checked:bg-secondary-500 peer-checked:hover:bg-secondary-600 peer-checked:text-white dark:peer-checked:bg-secondary-600 border border-secondary-400',
        'success' => 'bg-green-200 dark:bg-green-950 peer-checked:bg-green-500 peer-checked:hover:bg-green-600 peer-checked:text-white dark:peer-checked:bg-green-600 border border-green-400',
        'warning' => 'bg-yellow-200 dark:bg-yellow-950 peer-checked:bg-yellow-400 peer-checked:hover:bg-yellow-500 peer-checked:text-black dark:peer-checked:bg-yellow-500 border border-yellow-400',
        'danger' => 'bg-red-200 dark:bg-red-950 peer-checked:bg-red-500 peer-checked:hover:bg-red-600 peer-checked:text-white dark:peer-checked:bg-red-600 border border-red-400',
        'default' => 'bg-gray-200 dark:bg-gray-950 peer-checked:bg-gray-500 peer-checked:hover:bg-gray-600 peer-checked:text-white dark:peer-checked:bg-gray-600 border border-gray-400',
    ];

    $shapeClass = match ($shape) {
        'circle' => 'rounded-full',
        'rounded' => 'rounded-md',
        'square' => 'rounded-none',
        default => 'rounded-full',
    };


    $baseId = $id ?: $name ?: 'checkbox-' . str_pad(mt_rand(0, 9999), 4, '0', STR_PAD_LEFT);
    $inputName = $name ?: $baseId;

    $groupId = 'group-' . $baseId;
    $styles = $colorStyles[$color] ?? $colorStyles['default'];

    $selectedValues = old($inputName, $selected);
    $selectedValues = is_array($selectedValues) ? $selectedValues : (array) $selectedValues;

    $hasError = $errors->has($inputName) || $errorText;
    $describedBy = $hasError ? 'error-' . $groupId : ($helperText ? 'helper-' . $groupId : null);

    $isMultiple = count($options) > 1;
@endphp

<div class="space-y-4">
    @if ($label)
        <span id="{{ $groupId }}-label" class="block font-semibold text-gray-700 dark:text-gray-300 mb-1">
            {{ $label }}
        </span>
    @endif

    <div
        id="{{ $groupId }}"
        role="group"
        aria-labelledby="{{ $groupId }}-label"
        @if($describedBy) aria-describedby="{{ $describedBy }}" @endif
        {{ $attributes->merge(['class' => 'flex flex-wrap gap-x-4 gap-y-2']) }}
    >
        @foreach ($options as $value => $text)
            @php $checkboxId = $baseId . '_' . $loop->index; @endphp

            <label for="{{ $checkboxId }}" class="flex items-center space-x-2 cursor-pointer select-none">
                <input
                    type="checkbox"
                    id="{{ $checkboxId }}"
                    name="{{ $isMultiple ? $inputName . '[]' : $inputName }}"
                    value="{{ $value }}"
                    class="peer hidden"
                    @if ($isMultiple)
                        @checked(in_array($value, $selectedValues))
                    @else
                        @checked((bool) $selectedValues)
                    @endif
                    aria-invalid="{{ $hasError ? 'true' : 'false' }}"
                    aria-describedby="{{ $hasError ? 'error-' . $baseId : null }}"
                />

                <div class="py-1 my-1 h-5 w-5 flex items-center justify-center transition-all duration-200 {{ $shapeClass }} {{ $styles }} {{ $hasError ? 'ring-red-500 focus:ring-red-400 border border-red-300' : '' }}">
                    <div class="bg-white {{ $shapeClass }} w-2 h-2 transition-transform scale-0 peer-checked:scale-105"></div>
                </div>

                <span class="text-gray-700 dark:text-gray-300 text-sm">{{ $text }}</span>
            </label>
        @endforeach
    </div>

    @if ($helperText && !$hasError)
        <p id="helper-{{ $groupId }}" class="text-sm text-gray-500 dark:text-gray-400 mt-1">
            {{ $helperText }}
        </p>
    @endif

    @if ($errorText)
        <p id="error-{{ $groupId }}" class="text-sm text-red-500 mt-1" role="alert">
            {{ $errorText }}
        </p>
    @elseif ($errors->has($inputName))
        <p id="error-{{ $groupId }}" class="text-sm text-red-500 mt-1" role="alert">
            {{ $errors->first($inputName) }}
        </p>
    @endif
</div>
