
{{-- Title of the view --}}
@section('title', __('Sessions actives'))
<section class="w-full">
    @include('partials.settings-heading')

    <x-settings.layout>

        <livewire:create-session>
    </x-settings.layout>
</section>
