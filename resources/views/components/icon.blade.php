@props([
    'name',
    'class' => '',
    'size' => '6', 
    'scale' => false,
    'ariaLabel' => null,
    'ariaHidden' => true,
])

@php
    $sizeClass = "w-{$size} h-{$size}";
    $scaleClass = $scale ? 'hover:scale-110 transition-transform duration-500' : '';

    $classAttribute = trim(implode(' ', [
        'fill-current stroke-current',
        $sizeClass,
        $scaleClass,
        $class,
    ]));

    $path = resource_path("svg/{$name}.svg");

    if (file_exists($path)) {
        $svg = file_get_contents($path);

        $accessibility = $ariaHidden
            ? 'aria-hidden="true"'
            : ($ariaLabel
                ? 'role="img" aria-label="' . e($ariaLabel) . '"'
                : '');

        $svg = preg_replace(
            '/<svg\b([^>]*)>/',
            '<svg$1 class="' . e($classAttribute) . '" ' . $accessibility . '>',
            $svg,
            1,
        );
    } else {
        $svg = "<!-- Icon not found: {$name} -->";
    }
@endphp

{!! $svg !!}
