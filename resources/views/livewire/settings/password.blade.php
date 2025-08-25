

{{-- Title of the view --}}
@section('title', __('Password'))

<section class="w-full">
    @include('partials.settings-heading')

    <x-settings.layout :heading="__('Update password')" :subheading="__('Ensure your account is using a long, random password to stay secure')">
        <livewire:create-password>
    </x-settings.layout>
</section>
