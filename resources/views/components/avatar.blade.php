@props([
    'src' => '',
    'status' => 'offline', // options: online, away, busy, offline
    'alt' => 'avatar',
    'name' => '', 
])

@php
    $colors = [
        'online' => 'bg-green-500',
        'away' => 'bg-yellow-500',
        'busy' => 'bg-red-500',
        'offline' => 'bg-gray-400',
    ];

    // Initials
    $initials = '';
    if ($name) {
        $parts = explode(' ', $name);
        $initials = strtoupper(substr($parts[0], 0, 1));
        if (count($parts) > 1) {
            $initials .= strtoupper(substr($parts[1], 0, 1));
        }
    }
@endphp

<div
    class="relative h-[40px] w-[40px] rounded-full border-2 border-white dark:border-dark-3 bg-gray-200 flex items-center justify-center text-white font-semibold">
    @if ($src)
        <img src="{{ $src }}" alt="{{ $name }}"
            class="h-full w-full rounded-full object-cover object-center" />
    @else
        <span>{{ $initials ?: '?' }}</span>
    @endif

    {{-- Status indicator --}}
    <span class="absolute right-0 -top-1 h-3 w-3 rounded-full {{ $colors[$status] }}">
    </span>
</div>
