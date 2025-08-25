<x-layouts.layout>
    <div class="relative">
        <div class="absolute top-6 left-6 sm:left-auto sm:right-6 sm:top-7">
            <x-toggle icons="true" color="primary" shape="circle" />
        </div>

        <header class="absolute top-6 right-6 sm:left-auto sm:right-25 sm:top-7 text-sm mb-6 not-has-[nav]:hidden">
            @if (Route::has('login'))
                <nav class="flex items-center justify-end gap-4">
                    @auth
                        <x-link label="Dashboard" bgColor="primary" href="{{ url('/dashboard') }}" />
                    @else
                        <x-link label="Log in" bgColor="secondary" href="{{ route('login') }}" />

                        @if (Route::has('register'))
                            <x-link label="Register" bgColor="primary" href="{{ route('register') }}" />
                        @endif
                    @endauth
                </nav>
            @endif
        </header>
        <div
            class="absolute top-[15vh] flex items-center justify-center w-full transition-opacity opacity-100 duration-750 lg:grow starting:opacity-0">
            <main class="flex max-w-[335px] w-full flex-col-reverse lg:max-w-4xl lg:flex-row">
                <div
                    class="text-[13px] leading-[20px] flex-1 p-6 pb-12 lg:p-20 bg-primary-100 dark:bg-primary-900  shadow dark:shadow rounded-es-lg rounded-ee-lg lg:rounded-ss-lg lg:rounded-ee-none text-primary-900 dark:text-white">
                    <h1 class="mb-1 font-medium ">Let's get started</h1>
                    <p class="mb-2 ">Laravel has an incredibly rich ecosystem. <br>We suggest starting with the
                        following.
                    </p>
                    <ul class="flex flex-col mb-4 lg:mb-6">
                        <li class="flex items-center gap-4 py-2 relative ">
                            <span class="relative right-0.5">
                                <x-icon name="radio" size="4" />
                            </span>
                            <span>
                                Read the
                                <x-link href="https://laravel.com/docs" label="Documentation" color="primary"
                                    icon="arrow-right-up-line" iconSize="4" size="xs" target="_blank" />
                            </span>
                        </li>
                        <li
                            class="flex items-center gap-4 py-2 relative  before:top-0 before:start-[0.4rem] before:absolute">
                            <span class="relative py-1 ">
                                <x-icon name="radio" size="4" />
                            </span>
                            <span>
                                Watch video tutorials at
                                <x-link href="https://laracasts.com" label="Laracasts" color="primary"
                                    icon="arrow-right-up-line" iconSize="4" size="xs" target="_blank" />
                            </span>
                        </li>
                    </ul>
                    <ul class="flex gap-3 text-sm leading-normal">
                        <li>
                            <x-link href="https://cloud.laravel.com" label="Deploy Now" bgColor="primary"
                                target="_blank" />
                        </li>
                    </ul>

                </div>

                <div
                    class="bg-primary-50 dark:bg-primary-950 relative lg:-ms-px -mb-px lg:mb-0 rounded-t-lg lg:rounded-t-none lg:rounded-e-lg! aspect-[335/376] lg:aspect-auto w-full lg:w-[438px] shrink-0 overflow-hidden">

                    {{-- Contenedor centrado --}}
                    <div
                        class="flex justify-center items-center h-full w-full text-primary-300 dark:text-primary-600 transition-all duration-1000 starting:opacity-0 starting:translate-y-6">
                        <img src="{{ asset('img/blade.svg') }}" width="256" alt="Logo">
                    </div>

                    <div
                        class="absolute inset-0 rounded-t-lg lg:rounded-t-none lg:rounded-e-lg shadow-[inset_0px_0px_0px_1px_rgba(26,26,0,0.16)] dark:shadow-[inset_0px_0px_0px_1px_#fffaed2d]">
                    </div>
                </div>

            </main>
        </div>

        @if (Route::has('login'))
            <div class="h-14.5 hidden lg:block"></div>
        @endif
    </div>
</x-layouts.layout>
