<x-layouts.layout>
    <div>
        <header class="absolute top-2 left-0 w-full z-50 flex items-center justify-between px-3">
            <div class="absolute right-0 top-1 lg:top-0 flex items-center gap-3">
                <div class="relative flex items-center space-x-3 top-1 right-3">
                    <!-- ====== Search Section End -->
                    <div class="absolute right-20">
                        <x-toggle icons="true" color="primary" shape="circle" />
                    </div>
                    <!-- User Notification -->
                    <div class="absolute right-4">
                        <livewire:notification.sidebar>
                    </div>

                    <!-- User Dropdown -->
                    <x-dropdown spanLabel=" {{ auth()->user()->initials() }}" class="right-2 ">
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
                                <x-link-nav role="button" tabindex="0" label="{{ __('Log Out') }}" icon="log-out"
                                    iconPosition="left" class="hover:bg-primary-200/80 rounded-md mt-2"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();" />
                            </form>
                        </div>
                    </x-dropdown>
                </div>
            </div>
        </header>

        <div x-cloak class="flex h-screen pt-5 md:pt-0" x-data="{ openSidebar: false }">

            <div class="absolute top-3 -left-2 md:hidden ">
                <x-button x-on:click="openSidebar = !openSidebar" color="none"
                    class="text-primary-900 hover:text-primary-950 dark:text-white">
                    <x-icon name="menu" size="8" />
                </x-button>
            </div>

            <div class="fixed inset-0 bg-primary-500/25 z-30 md:hidden" x-show="openSidebar"
                x-on:click="openSidebar = false" x-transition.opacity>
            </div>

            <aside
                class="fixed md:relative top-0 left-0 w-64 bg-primary-100 dark:bg-gradient-to-b dark:from-primary-950 dark:to-primary-900 flex flex-col h-screen transform transition-transform duration-200 ease-in-out border-r dark:border-primary-900 border-primary-200 md:translate-x-0 z-100"
                :class="{ '-translate-x-full': !openSidebar, 'translate-x-0': openSidebar }">

                <div class="py-1 flex items-end justify-end">
                    <x-button class="md:hidden" x-on:click="openSidebar = false" color="none">
                        <x-icon name="close" size="8" />
                    </x-button>
                </div>
                <div>
                    <x-link href="{{ route('dashboard') }}" >
                        <img src="{{ asset('img/blade.svg') }}"  width="256">
                    </x-link>
                </div>
                <div class="mx-4">
                    <x-input.search width="full" color="primary" placeholder="{{ __('Search') }}..." />
                </div>
                <!-- Nav -->
                <x-layouts.nav.sidebar-nav />

                <div class="mx-4 my-2 border-t-2 border-primary-200 dark:border-primary-700">
                    <x-link-nav href="https://github.com/laravel/livewire-starter-kit" label="{{ __('Repository') }}"
                        icon="git-branch" iconPosition="left" target="_blank"
                        class="hover:bg-primary-200/80 rounded-md" />

                    <x-link-nav href="https://github.com/laravel/livewire-starter-kit"
                        label="{{ __('Documentation') }}" icon="book-outline" iconPosition="left" target="_blank"
                        class="hover:bg-primary-200/80 rounded-md" />
                </div>
            </aside>

            <main class="flex-1 px-1 pt-4">
                {{ $slot }}
            </main>
        </div>
    </div>
</x-layouts.layout>
