<nav class="flex-1 px-4 py-3 space-y-1 overflow-y-auto">
    <x-link-nav href="{{ route('dashboard') }}" icon="home" iconPosition="left"
        class="hover:bg-primary-200/80 dark:text-primary-100 hover:rounded-md {{ request()->routeIs('dashboard') ? 'font-medium bg-primary-200/80 border-b rounded-md dark:bg-primary-950/80' : ' text-primary-600 dark:text-primary-100' }}">
        {{ __('Dashboard') }}
    </x-link-nav>

    <x-link-nav href="#" label="{{ __('Users') }}" icon="users" iconPosition="left" count="5" wire:navigate
        class="hover:bg-primary-200/80 hover:rounded-md" />

    <x-link-nav href="#" label="{{ __('Documents') }}" icon="documents" iconPosition="left" wire:navigate
        class="hover:bg-primary-200/80 hover:rounded-md" />

    <x-link-nav href="#" label="{{ __('Inbox') }}" icon="inbox-in" iconPosition="left" wire:navigate
        class="hover:bg-primary-200/80 hover:rounded-md" count="3" />
</nav>
