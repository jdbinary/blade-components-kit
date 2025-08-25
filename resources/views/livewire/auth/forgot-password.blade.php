<?php

use Illuminate\Support\Facades\Password;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('components.layouts.auth')] class extends Component {
    public string $email = '';

    /**
     * Send a password reset link to the provided email address.
     */
    public function sendPasswordResetLink(): void
    {
        $this->validate([
            'email' => ['required', 'string', 'email'],
        ]);

        Password::sendResetLink($this->only('email'));

        session()->flash('status', __('A reset link will be sent if the account exists.'));
    }
}; ?>

<div class="flex flex-col gap-6">
    <x-auth-header :title="__('Forgot password')" :description="__('Enter your email to receive a password reset link')" />

    <!-- Session Status -->
    <x-auth-session-status class="text-center" :status="session('status')" />

    <form wire:submit="sendPasswordResetLink" class="flex flex-col gap-6">
        <!-- Email Address -->
        <x-input.email id="email" :label="__('Email address')" placeholder="email@example.com" width="full" autocomplete="email" wire:model="email" color="primary"/>
        
        <x-button label="{{ __('Email password reset link') }}" width="full" size="sm" type="submit" color="primary" />
    </form>

    <div class="space-x-1 rtl:space-x-reverse text-center text-sm text-primary-600 dark:text-primary-400">
        <span>{{ __('Or, return to') }}</span>
        <x-link href="{{ route('login') }}" label="{{ __('log in') }}" class="hover:underline" />
    </div>
</div>
