@props([
    'url' => url()->current(),
    'text' => 'Mira esto ',
    'networks' => ['facebook', 'twitter', 'linkedin', 'whatsapp', 'copy'],
    'message' => 'Enlace copiado',
    'position' => 'top-right', // top-right, top-left, bottom-right, bottom-left
])

<div {{ $attributes->merge(['class' => 'flex items-center gap-1']) }} x-data>
    @foreach ($networks as $network)
        @switch($network)
            @case('facebook')
                <x-link href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode($url) }}" target="_blank" size="xs"
                    rel="noopener noreferrer" class="p-2 rounded-full transition">
                    <x-icon name="facebook" size="6" />
                </x-link>
            @break

            @case('x')
                <x-link href="https://x.com/intent/tweet?url={{ urlencode($url) }}&text={{ urlencode($text) }}" target="_blank"
                    size="xs" rel="noopener noreferrer" class="p-2 rounded-full transition">
                    <x-icon name="x-logo" size="6" />
                </x-link>
            @break

            @case('linkedin')
                <x-link
                    href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode($url) }}&title={{ urlencode($text) }}"
                    target="_blank" size="xs" rel="noopener noreferrer" class="p-2 rounded-full transition">
                    <x-icon name="linkedin" size="6" />
                </x-link>
            @break

            @case('whatsapp')
                <x-link href="https://api.whatsapp.com/send?text={{ urlencode($text . ' ' . $url) }}" target="_blank" size="xs"
                    rel="noopener noreferrer" class="p-2 rounded-full transition">
                    <x-icon name="whatsapp-icon" size="6" />
            </x-link>
            @break

            @case('copy')
                <div x-data>
                    <x-button type="button" size="xs" color="none"
                        x-on:click="navigator.clipboard.writeText('{{ $url }}');
            $dispatch('notify', { message: '', type: '' });"
                        class="p-2 rounded-full transition cursor-pointer">
                        <x-icon name="link" size="6" />
                    </x-button>

                    <x-toast x-on:notify.window="show = true; setTimeout(() => show = false, 3000)" type="success" position="{{$position}}"
                        message="{{ $message }}" :showButton="false" icon="link" class="absolute top-0 left-0 mt-10" />
                </div>
            @break
        @endswitch
    @endforeach
</div>
