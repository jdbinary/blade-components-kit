
{{-- Title of the view --}}
@section('title', __('Profile'))
<section class="w-full">
    @include('partials.settings-heading')

    <x-settings.layout>
        <livewire:create-profile>

        <livewire:settings.delete-user-form />
    </x-settings.layout>
</section>
