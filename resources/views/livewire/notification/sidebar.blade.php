<div  x-data="{ notifyOpen: false }"> 
    <x-button x-on:click="notifyOpen = true" class="relative" color="none" class="text-primary-700 dark:text-primary-200">
        <x-icon name="bell" size="9" />
        <span
            class="absolute right-5 top-0 inline-flex items-center justify-center px-1 py-0.5 text-xs font-bold leading-none text-white bg-red-600 rounded-full">3
        </span>
    </x-button>

    <div x-show="notifyOpen" x-cloak class="fixed inset-0 bg-primary-500/25 z-40" x-transition.opacity
        x-on:click="notifyOpen = false"></div>

    <aside x-show="notifyOpen" x-cloak
        class="fixed top-0 right-0 w-80 h-full bg-primary-100 dark:bg-gradient-to-b dark:from-primary-950 dark:to-primary-900 shadow-xl z-50 flex flex-col"
        x-transition:enter="transform transition ease-in-out duration-300" x-transition:enter-start="translate-x-full"
        x-transition:enter-end="translate-x-0" x-transition:leave="transform transition ease-in-out duration-300"
        x-transition:leave-start="translate-x-0" x-transition:leave-end="translate-x-full">


        <div class="flex items-center justify-between p-4 border-b border-primary-200 dark:border-primary-700">
            <h2 class="text-lg font-semibold text-primary-800 dark:text-primary-100">
                {{ __('Notifications') }} (2  {{ __('Not read') }})
            </h2>
            <x-button x-on:click="notifyOpen = false"
                class="p-2 rounded-md" color="none">
                <x-icon name="close" size="5" />
            </x-button>
        </div>

        <div class="flex-1 overflow-y-auto p-4 space-y-3">

            <div
                class="flex items-start space-x-2 p-3 rounded-lg bg-primary-50 dark:bg-primary-800 border-l-4 border-primary-500">

                <x-input.checkbox-group :options="['check' => '']" shape="rounded" color="primary" />

                <div class="flex-1 text-primary-800 dark:text-primary-200">
                    <p class="text-sm "><p class="font-semibold">{{ __('Unread') }}</p>{{ __('New update available.') }} </p>
                    
                    <div class="mt-2 flex space-x-2">
                        <x-button label="{{ __('Mark as read') }}" size="xs" color="gray" />
                        <x-button label="{{ __('Delete') }}" size="xs" color="danger" />
                    </div>
                </div>
            </div>

            <div
                class="flex items-start space-x-2 p-3 rounded-lg bg-primary-50  dark:bg-primary-800 border-l-4 border-primary-500">

                <x-input.checkbox-group :options="['check' => '']" shape="rounded" color="primary" />

                <div class="flex-1 text-primary-800 dark:text-primary-200">
                    <p class="text-sm "><p class="font-semibold">{{ __('Unread') }}</p> {{ __('You have a new message.') }}</p>
                    <div class="mt-2 flex space-x-2">
                        <x-button label="{{ __('Mark as read') }}" size="xs" color="gray" />
                        <x-button label="{{ __('Delete') }}" size="xs" color="danger" />
                    </div>
                </div>
            </div>

            <div class="flex items-start space-x-2 p-3 bg-green-100 dark:bg-green-800 rounded-md border-l-4 border-green-500">

                <x-input.checkbox-group :options="['check' => '']" shape="rounded" color="success" />

                <div class="flex-1 text-primary-800 dark:text-primary-200">
                    <p class="text-sm  font-semibold"><p class="font-semibold text-green-500">{{ __('Read') }}</p> {{ __('Your profile has been updated successfully.') }}
                    </p>
                    <div class="mt-2 flex space-x-2">
                        <x-button label="{{ __('Mark as unread') }}" size="xs" color="gray" />
                        <x-button label="{{ __('Delete') }}" size="xs" color="danger" />
                    </div>
                </div>
            </div>
        </div>

        <div class="p-4 border-t border-primary-200 dark:border-primary-700 flex justify-between">
            <x-button label="{{ __('See all notifications') }}" size="xs" color="none" />
            <x-button label="{{ __('Mark as unread') }}" size="xs" color="primary" />
        </div>
    </aside>

</div>
