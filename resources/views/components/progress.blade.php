@props([
    'value' => 0 // progress value 
])

@php
    $color = match (true) {
        $value < 50 => 'bg-red-500',
        $value < 90 => 'bg-yellow-500',
        default => 'bg-green-500',
    };

    $textColor = match (true) {
        $value < 50 => 'text-red-900 dark:text-red-100',
        $value < 90 => 'text-yellow-900 dark:text-yellow-100',
        default => 'text-green-900 dark:text-green-100',
    };
@endphp

<div class="my-6">
    <div class="w-full bg-gray-200 dark:bg-gray-700 h-3 rounded-full">
        <div class="{{ $color }} h-3 rounded-full transition-all duration-500 ease-in-out" style="width: {{ $value }}%;"></div>
    </div>
    <p class="text-xs text-right mt-1 font-semibold {{ $textColor }}">{{ $value }}%</p>
</div>
