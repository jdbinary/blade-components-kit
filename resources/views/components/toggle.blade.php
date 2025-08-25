@props([
    'id' => null,
    'color' => 'default',
    'shape' => 'rounded',
    'icons' => false,
    'label' => 'Change color mode',
    'darkMode' => null, 
])

@php
    use Illuminate\Support\Str;

    $inputId = $id ?: 'toggle-' . Str::uuid();

    $colorStyles = [
        'primary' =>
            'bg-primary-100 text-primary-950 dark:bg-primary-900 dark:text-primary-100 border border-primary-300 dark:border-primary-700 hover:border-primary-500',
        'secondary' =>
            'bg-secondary-100 text-secondary-950 dark:bg-secondary-900 dark:text-secondary-100 border border-secondary-300 dark:border-secondary-700 hover:border-secondary-500',
        'success' =>
            'bg-green-100 text-green-950 dark:bg-green-900 dark:text-green-100 border border-green-300 dark:border-green-700 hover:border-green-500',
        'warning' =>
            'bg-yellow-100 text-yellow-950 dark:bg-yellow-900 dark:text-yellow-100 border border-yellow-300 dark:border-yellow-700 hover:border-yellow-500',
        'danger' =>
            'bg-red-100 text-red-950 dark:bg-red-900 dark:text-red-100 border border-red-300 dark:border-red-700 hover:border-red-500',
        'default' =>
            'bg-white text-gray-900 dark:bg-neutral-800 dark:text-white border border-gray-300 dark:border-neutral-700 hover:border-gray-500',
    ];

    $dotColors = [
        'primary' => 'bg-primary-500 dark:bg-primary-400 peer-checked:bg-primary-700',
        'secondary' => 'bg-secondary-500 dark:bg-secondary-400 peer-checked:bg-secondary-700',
        'success' => 'bg-green-500 dark:bg-green-400 peer-checked:bg-green-700',
        'warning' => 'bg-yellow-500 dark:bg-yellow-400 peer-checked:bg-yellow-700',
        'danger' => 'bg-red-500 dark:bg-red-400 peer-checked:bg-red-700',
        'default' => 'bg-gray-300 dark:bg-gray-400 peer-checked:bg-gray-500',
    ];

    $shapeClass = match ($shape) {
        'square' => '',
        'circle' => 'rounded-full',
        'rounded' => 'rounded-md',
        default => '',
    };

    $baseStyles = $colorStyles[$color] ?? $colorStyles['primary'];
    $dotStyle = $dotColors[$color] ?? $dotColors['primary'];

    $darkModeJs = $darkMode === null ? 'localStorage.getItem(\'theme\') === \'dark\'' : ($darkMode ? 'true' : 'false');
@endphp
<div x-cloak 
    @if ($icons) x-data="{
            darkMode: {{ $darkModeJs }},
            toggle() {
                this.darkMode = !this.darkMode;
                localStorage.setItem('theme', this.darkMode ? 'dark' : 'light');
                document.documentElement.classList.toggle('dark', this.darkMode);
            }
        }"
        x-init="document.documentElement.classList.toggle('dark', darkMode);
            $refs.checkbox.checked = darkMode;"
        
    @endif>
    <label for="{{ $inputId }}"
        class="flex items-center cursor-pointer select-none text-dark dark:text-white relative"
        aria-label="{{ $label }}">

        <div  class="relative">
            <input type="checkbox" x-ref="checkbox" @if ($icons) x-on:change="toggle" @endif
                class="peer sr-only color-scheme" id="{{ $inputId }}" />

            <div class="relative h-8 w-14 transition {{ $shapeClass }} {{ $baseStyles }} peer-checked:bg-opacity-70">
                @if ($icons)
                    <x-icon name="moon" class="absolute left-2 top-1/2 -translate-y-1/2 -translate-x-1" />
                    <x-icon name="sunny" class="absolute right-2 top-1/2 -translate-y-1/2 translate-x-1" />
                @endif
            </div>

            <div
                class="absolute flex items-center justify-center w-6 h-6 transition {{ $shapeClass }} {{ $dotStyle }} left-1 top-1 peer-checked:translate-x-full">
            </div>
        </div>
    </label>
</div>
<script>
    // This script ensures the correct theme is applied on initial load
    if (localStorage.theme === 'dark' 
        || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)
    ) {
        document.documentElement.classList.add('dark');
    } else {
        document.documentElement.classList.remove('dark');
    }
</script>