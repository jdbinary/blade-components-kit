<div>
    <form wire:submit="updateProfileInformation" class="my-6 w-full space-y-6">
        <x-input.text wire:model="name" placeholder="{{ __('Name') }}" autofocus autocomplete="name" width="full"
            color="primary" />

        <div>
            <x-input.email wire:model="email" placeholder="{{ __('Email') }}" autocomplete="email" width="full"
                color="primary" />

            @if (auth()->user() instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !auth()->user()->hasVerifiedEmail())
                <div>
                    <div>
                        {{ __('Your email address is unverified.') }}


                        <x-link wire:click.prevent="resendVerificationNotification"
                            {{ __('Click here to re-send the verification email.') }} />
                    </div>
                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium !dark:text-green-400 !text-green-600">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4">
            <div class="flex items-center justify-end">
                <x-button color="primary" type="submit" class="w-full">
                    {{ __('Save') }}
                </x-button>
            </div>

            <x-alert on="profile-updated" color="success">
                {{ __('Profile updated successfully.') }}
            </x-alert>
        </div>
    </form>
</div>
