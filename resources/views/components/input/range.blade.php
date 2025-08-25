@props([
    'id' => 'range-' . \Illuminate\Support\Str::random(6),
    'name' => '',
    'label' => '',
    'color' => 'default',
    'width' => 'xl',
    'value' => 0,
    'min' => 0,
    'max' => 100,
    'step' => 1,
    'helperText' => '',
    'showValue' => true,
    'valuePosition' => 'right',
    'helperText' => '',
])

@php
    

    $colorStyles = [
        'primary' =>
            'bg-white text-primary-950 placeholder:text-primary-600 dark:bg-primary-900 dark:text-primary-100 focus:ring-primary-500 focus:ring-1 focus:outline-none border border-primary-300',
        'secondary' =>
            'bg-white text-secondary-950 placeholder:text-secondary-600 dark:bg-secondary-900 dark:text-secondary-100 focus:ring-secondary-500 focus:ring-1 focus:outline-none border border-secondary-300',
        'success' =>
            'bg-white text-green-950 placeholder:text-green-600 dark:bg-green-900 dark:text-green-100 focus:ring-green-500 focus:ring-1 focus:outline-none border border-green-300',
        'warning' =>
            'bg-white text-yellow-950 placeholder:text-yellow-600 dark:bg-yellow-900 dark:text-yellow-100 focus:ring-yellow-500 focus:ring-1 focus:outline-none border border-yellow-300',
        'danger' =>
            'bg-white text-red-950 placeholder:text-red-600 dark:bg-red-900 dark:text-red-100 focus:ring-red-500 focus:ring-1 focus:outline-none border border-red-300',
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

    $inputId = $id;
    $styles = $colorStyles[$color] ?? $colorStyles['default'];
    $inputName = $name ?: $inputId;
    $inputValue = old($inputName, $value);
@endphp

<div class="{{ $widthClass }} space-y-2">

    @if ($label)
        <label for="{{ $id }}" class="block mb-1 font-semibold text-gray-700 dark:text-gray-300">
            {{ $label }}
        </label>
    @endif

    @switch($valuePosition)
        @case('left')
            <div class="flex items-center my-1  space-x-2">

                @if ($showValue)
                    <span id="val-{{ $id }}" class="text-sm text-gray-700 dark:text-gray-300">
                        {{ old($inputName, $value) }}
                    </span>
                @endif

                <input type="range" id="{{ $id }}" name="{{ $inputName }}" min="{{ $min }}"
                    max="{{ $max }}" step="{{ $step }}" value="{{ old($inputName, $value) }}"
                    @if (!$label) aria-label="{{ $helperText ?: 'Control Slide' }}" @endif
                    {{ $attributes->merge([
                        'class' => "py-1 my-1 $widthClass h-2 rounded-lg appearance-none cursor-pointer $styles",
                    ]) }}
                    oninput="document.getElementById('val-{{ $id }}').innerText = this.value" />
            </div>
        @break

        @case('top-left')
            <div class="flex flex-col my-1  space-y-2 items-start">

                @if ($showValue)
                    <span id="val-{{ $id }}" class="text-sm text-gray-700 dark:text-gray-300">
                        {{ old($inputName, $value) }}
                    </span>
                @endif

                <input type="range" id="{{ $id }}" name="{{ $inputName }}" min="{{ $min }}"
                    max="{{ $max }}" step="{{ $step }}" value="{{ old($inputName, $value) }}"
                    @if (!$label) aria-label="{{ $helperText ?: 'Control Slide' }}" @endif
                    {{ $attributes->merge([
                        'class' => "py-1 my-1 $widthClass h-2 rounded-lg appearance-none cursor-pointer $styles",
                    ]) }}
                    oninput="document.getElementById('val-{{ $id }}').innerText = this.value" />
            </div>
        @break

        @case('top-right')
            <div class="flex flex-col my-1  space-y-2 items-end">

                @if ($showValue)
                    <span id="val-{{ $id }}" class="text-sm text-gray-700 dark:text-gray-300">
                        {{ old($inputName, $value) }}
                    </span>
                @endif

                <input type="range" id="{{ $id }}" name="{{ $inputName }}" min="{{ $min }}"
                    max="{{ $max }}" step="{{ $step }}" value="{{ old($inputName, $value) }}"
                    @if (!$label) aria-label="{{ $helperText ?: 'Control Slide' }}" @endif
                    {{ $attributes->merge([
                        'class' => "py-1 my-1 $widthClass h-2 rounded-lg appearance-none cursor-pointer $styles",
                    ]) }}
                    oninput="document.getElementById('val-{{ $id }}').innerText = this.value" />
            </div>
        @break


        @default
            <div class="flex items-center my-1  space-x-2">

                <input type="range" id="{{ $id }}" name="{{ $inputName }}" min="{{ $min }}"
                    max="{{ $max }}" step="{{ $step }}" value="{{ old($inputName, $value) }}"
                    @if (!$label) aria-label="{{ $helperText ?: 'Control Slide' }}" @endif
                    {{ $attributes->merge([
                        'class' => "py-1 my-1 $widthClass h-2 rounded-lg appearance-none cursor-pointer $styles",
                    ]) }}
                    oninput="document.getElementById('val-{{ $id }}').innerText = this.value" />

                @if ($showValue)
                    <span id="val-{{ $id }}" class="text-sm text-gray-700 dark:text-gray-300">
                        {{ old($inputName, $value) }}
                    </span>
                @endif
            </div>
    @endswitch

    @if ($helperText)
        <p class="text-sm text-gray-500 dark:text-gray-400">
            {{ $helperText }}
        </p>
    @endif


</div>

<style>
    #{{ $id }}::-webkit-slider-thumb {
        -webkit-appearance: none;
        appearance: none;
        height: 1rem;
        width: 1rem;
        border-radius: 9999px;
        background-color: white;
        cursor: pointer;
        border: none;
        box-shadow: 0 0 0 2px gray;
    }

    #{{ $id }}::-moz-range-thumb {
        height: 1rem;
        width: 1rem;
        border-radius: 9999px;
        background-color: white;
        cursor: pointer;
        border: none;
    }

    #{{ $id }}:focus {
        outline: none;
    }
</style>
