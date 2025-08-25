<x-layouts.layout>
    <div x-cloak x-data="{ mobileOpen: false, userMenu: false }">
        <!-- Header -->
        <header class="border-b border-primary-200 bg-primary-100 dark:bg-primary-950">
            <div class="container mx-auto flex items-center justify-between px-4 py-3">

                <!-- Mobile toggle -->
                <x-button x-on:click="mobileOpen = true" color="none"
                    class="lg:hidden p-2 text-primary-900 hover:text-primary-950 dark:text-white">
                    <x-icon name="menu" size="8" />
                </x-button>


                <!-- Navbar (desktop) -->
                <nav class="hidden lg:flex space-x-4">
                    <x-link href="{{ route('dashboard') }}" wire:navigate>
                        <img src="{{ asset('img/blade.svg') }}" alt="" width="256">
                    </x-link>
                    <x-link-nav href="{{ route('dashboard') }}" icon="home" iconPosition="left"
                        class="px-3 py-2 text-sm font-medium border-b-2 {{ request()->routeIs('dashboard') ? 'border-primary-600 text-primary-600' : 'border-transparent text-primary-600 dark:text-primary-300 hover:border-primary-400' }}">
                        {{ __('Dashboard') }}
                    </x-link-nav>
                    <x-link-nav href="#" count="5" icon="users" iconPosition="left"
                        class="px-3 py-2 text-sm font-medium border-b-2  border-transparent text-primary-600 dark:text-primary-300 hover:border-primary-400 }}">
                        {{ __('Users') }}
                    </x-link-nav>
                    <x-link-nav href="#" icon="documents" iconPosition="left"
                        class="px-3 py-2 text-sm font-medium border-b-2  border-transparent text-primary-600 dark:text-primary-300 hover:border-primary-400 }}">
                        {{ __('Documents') }}
                    </x-link-nav>
                    <x-link-nav href="#" icon="inbox-in" iconPosition="left"
                        class="px-3 py-2 text-sm font-medium border-b-2  border-transparent text-primary-600 dark:text-primary-300 hover:border-primary-400 }}">
                        {{ __('Inbox') }}
                    </x-link-nav>
                </nav>

                <div class="relative flex items-center space-x-3">
                    <!-- ====== Search Section End -->
                    <div class="absolute right-20">
                        <x-toggle icons="true" color="primary" shape="circle" />
                    </div>
                    <div class="absolute right-4">
                        <livewire:notification.sidebar>
                    </div>

                    <!-- User Dropdown -->
                    <x-dropdown spanLabel=" {{ auth()->user()->initials() }}" class="top-1 right-2 ">
                        <div class="flex flex-col p-2">
                            <div class="px-0 pb-5 text-sm font-normal border-b border-primary-100">
                                <div class="flex items-center gap-2 text-start text-sm">
                                    <span class="relative flex h-8 w-8 shrink-0 overflow-hidden rounded-lg">
                                        <span
                                            class="flex h-full w-full items-center justify-center rounded-lg bg-primary-100 dark:bg-primary-600 text-primary-900  dark:text-white">
                                            {{ auth()->user()->initials() }}
                                        </span>
                                    </span>

                                    <div
                                        class="grid flex-1 text-start text-sm leading-tight text-primary-900  dark:text-white">
                                        <span class="truncate font-semibold">{{ auth()->user()->name }}</span>
                                        <span class="truncate text-xs">{{ auth()->user()->email }}</span>
                                    </div>
                                </div>
                            </div>
                            <x-link-nav href="{{ route('settings.profile') }}" label="{{ __('Settings') }}"
                                icon="settings" iconPosition="left" class="hover:bg-primary-200/80 rounded-md mt-2" />
                            <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                @csrf
                                <x-link-nav role="button" tabindex="0" label="Finalizar sesión" icon="log-out"
                                    iconPosition="left" class="hover:bg-primary-200/80 rounded-md mt-2"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();" />
                            </form>
                        </div>
                    </x-dropdown>
                </div>
            </div>
        </header>

        <!-- Mobile Sidebar -->
        <div  x-cloak x-show="mobileOpen" class="lg:hidden fixed inset-0 z-50 flex"
            x-transition:enter="transform transition duration-300 ease-out" x-transition:enter-start="-translate-x-full"
            x-transition:enter-end="translate-x-0" x-transition:leave="transform transition duration-300 ease-in"
            x-transition:leave-start="translate-x-0" x-transition:leave-end="-translate-x-full">

            <!-- Overlay con sidebar dentro -->
            <aside
                class="relative w-64 h-full flex flex-col bg-primary-100 dark:bg-gradient-to-b dark:from-primary-950 dark:to-primary-900 border-r dark:border-primary-900 border-primary-200">

                <!-- Header -->
                <div class="py-3 px-1 text-lg font-semibold flex items-center justify-between">
                    <x-link href="{{ route('dashboard') }}" wire:navigate>
                        <img src="{{ asset('img/blade.svg') }}" alt="" width="256">
                    </x-link>
                    <x-button class="md:hidden" x-on:click="mobileOpen = false" color="none">
                        <x-icon name="close" size="8" />
                    </x-button>
                </div>

                <!-- Nav -->
                <x-layouts.nav.sidebar-nav />
                <!-- Footer Links -->
                <div class="mx-4 my-2 space-y-1">
                    <x-link-nav href="https://github.com/laravel/livewire-starter-kit" label="{{ __('Repository') }}"
                        icon="git-branch" iconPosition="left" target="_blank"
                        class="hover:bg-primary-200/80 rounded-md" />
                    <x-link-nav href="https://laravel.com/docs/starter-kits#livewire" label="{{ __('Documentation') }}"
                        icon="book-outline" iconPosition="left" target="_blank"
                        class="hover:bg-primary-200/80 rounded-md" />
                </div>
            </aside>

            <!-- Overlay -->
            <div class="flex-1 bg-primary-500/25" x-on:click="mobileOpen = false"></div>
        </div>

        <!-- Main Content -->
        <main class="p-4">
            {{ $slot }}
        </main>
    </div>
</x-layouts.layout>
