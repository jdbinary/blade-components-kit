<div>
    <form wire:submit="updatePassword" c00ass="mt-6 space-y-6">
        <x-input.password name="current_password" wire:model="current_password" placeholder="{{ __('Current password') }}"
            icon="true" color="primary" width="full" />
        <x-input.password name="password" wire:model="password" placeholder="{{ __('New password') }}" icon="true"
            color="primary" width="full" />

        <x-input.password name="password_confirmation" wire:model="password_confirmation"
            placeholder="{{ __('Confirm password') }}" icon="true" color="primary" width="full" />

        <div class="flex items-center gap-4">
            <div class="flex items-center justify-end">
                <x-button color="primary" type="submit" class="w-full">
                    {{ __('Save') }}
                </x-button>
            </div>

            <x-alert on="password-updated" color="success">
                {{ __('Password saved successfully.') }}
            </x-alert>
        </div>
    </form>
</div>
