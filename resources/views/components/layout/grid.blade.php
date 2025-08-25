@props([
    'cols' => 3,
    'rows' => 6,
    'gap' => 2,
])

@php
    $gridClasses = [
        "grid",
        "gap-{$gap}",
        "lg:grid-cols-{$cols}",
        "lg:grid-rows-{$rows}",
        "sm:grid-cols-1",
        "w-full",
        "px-2",
    ];
@endphp

<div {{ $attributes->merge(['class' => implode(' ', $gridClasses)]) }}>
    {{ $slot }}
</div>
