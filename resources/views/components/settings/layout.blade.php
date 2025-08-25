@php
    $links = [
        [
            'name' => __('Profile'),
            'icon' => 'profile',
            'url' => route('settings.profile'),
            'active' => request()->routeIs('settings.profile*'),
        ],
        [
            'name' => __('Password'),
            'icon' => 'password-key',
            'url' => route('settings.password'),
            'active' => request()->routeIs('settings.password*'),
        ],
        [
            'name' => __('Sessions actives'),
            'icon' => 'desktop',
            'url' => route('settings.sessions'),
            'active' => request()->routeIs('settings.sessions*'),
        ],
    ];
@endphp

<div class="flex items-start max-md:flex-col">
    <div class="me-10 w-full pb-4 md:w-[250px]">
        <nav>
            @foreach ($links as $link)
                <x-link-nav href="{{ $link['url'] }}" icon="{{ $link['icon'] }}"
                    iconPosition="left" :active="$link['active']" wire:navigate> 
                    {{ $link['name'] }}
                </x-link-nav>
            @endforeach
        </nav>

    </div>
    <div class="flex-1 self-stretch max-md:pt-6">
        <div class="mt-5 w-full max-w-lg">
            {{ $slot }}
        </div>
    </div>
</div>
