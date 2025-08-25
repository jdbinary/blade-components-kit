<div>
    <!-- Botón cerrar todas (solo si hay más de una sesión) -->
    @if(count($sessions) > 1)
        <div class="flex justify-end mb-4">
            <div class="flex items-center justify-end">
                <x-button color="danger" wire:click="logoutOtherDevices" class="w-full">
                    {{ __('Log out from all devices') }}
                </x-button>
            </div>

            <x-alert on="other-sessions-logged-out" color="success">
                {{ __('You have been logged out from all other devices.') }}
            </x-alert>
        </div>
    @endif

    <div class="space-y-3">
        @foreach ($sessions as $session)
            <div class="flex items-center justify-between p-4 bg-white dark:bg-primary-800 rounded-lg shadow-sm">
                <div class="flex items-center space-x-3">
                    <x-icon name="desktop" class="w-10 h-10 text-primary-500 dark:text-primary-300" />

                    <div>
                        <p class="text-sm font-medium text-primary-900 dark:text-primary-100">
                            {{ $session['user_agent'] }}
                        </p>
                        <p class="text-xs text-primary-500 dark:text-primary-400">
                            {{ $session['ip_address'] }} — {{ $session['last_activity'] }}
                            @if ($session['is_current'])
                                <span class="text-green-500 font-semibold">• {{ __('Current device') }}</span>
                            @endif
                        </p>
                    </div>
                </div>

                @unless ($session['is_current'])
                    <x-button wire:click="logoutSession('{{ $session['id'] }}')" size="xs" color="danger">
                        {{ __('Log out') }}
                    </x-button>
                @endunless
            </div>
        @endforeach
    </div>
</div>
