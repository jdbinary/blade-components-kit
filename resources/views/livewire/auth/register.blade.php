<?php

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('components.layouts.auth')] class extends Component {
    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';

    /**
     * Handle an incoming registration request.
     */
    public function register(): void
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);

        $validated['password'] = Hash::make($validated['password']);

        event(new Registered(($user = User::create($validated))));

        Auth::login($user);

        $this->redirectIntended(route('dashboard', absolute: false), navigate: true);
    }
}; ?>

<div class="flex flex-col gap-6">
    <x-auth-header :title="__('Create an account')" :description="__('Enter your details below to create your account')" />

    <!-- Session Status -->
    <x-auth-session-status class="text-center" :status="session('status')" />

    <form wire:submit="register" class="flex flex-col gap-6">
        <!-- Name -->

        <x-input.text id="name" :label="__('Name')" type="text" autofocus autocomplete="name" :placeholder="__('Full name')"
            wire:model="name" color="primary" width="full" />

        <!-- Email Address -->
        <x-input.email id="email" :label="__('Email address')" placeholder="email@example.com" width="full"
            autocomplete="email" wire:model="email" color="primary" />

        <!-- Password -->
        <x-input.password id="password" :label="__('Password')" :placeholder="__('Password')" width="full" :icon="true"
            wire:model="password" color="primary" />
        <!-- Confirm Password -->
        <x-input.password id="password_confirmation" :label="__('Confirm password')" password_confirmation width="full"
            :icon="true" wire:model="password_confirmation" color="primary" :placeholder="__('Confirm Password')" />

        <div class="flex items-center justify-end">
            <x-button label="{{ __('Create account') }}" width="full" type="submit" color="primary" />
        </div>
    </form>

    <div class="space-x-1 rtl:space-x-reverse text-center text-sm text-primary-600 dark:text-primary-400dark:text-zinc-400">
        <span>{{ __('Already have an account?') }}</span>
        <x-link href="{{ route('login') }}" label="{{ __('Log in') }}" class="hover:underline" />
    </div>
</div>
