<?php

use Illuminate\Auth\Events\Lockout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Volt\Component;

new #[Layout('components.layouts.auth')] class extends Component {
    #[Validate('required|string|email')]
    public string $email = '';

    #[Validate('required|string')]
    public string $password = '';

    public bool $remember = false;

    /**
     * Handle an incoming authentication request.
     */
    public function login(): void
    {
        $this->validate();

        $this->ensureIsNotRateLimited();

        if (!Auth::attempt(['email' => $this->email, 'password' => $this->password], $this->remember)) {
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'email' => __('auth.failed'),
            ]);
        }

        RateLimiter::clear($this->throttleKey());
        Session::regenerate();

        $this->redirectIntended(default: route('dashboard', absolute: false), navigate: true);
    }

    /**
     * Ensure the authentication request is not rate limited.
     */
    protected function ensureIsNotRateLimited(): void
    {
        if (!RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout(request()));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'email' => __('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    /**
     * Get the authentication rate limiting throttle key.
     */
    protected function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->email) . '|' . request()->ip());
    }
}; ?>

<div class="flex flex-col gap-6 text-primary-950 dark:text-primary-100">
    <x-auth-header :title="__('Log in to your account')" :description="__('Enter your email and password below to log in')" />

    <!-- Session Status -->
    <x-auth-session-status class="text-center" :status="session('status')" />

    <form wire:submit="login" class="flex flex-col gap-6">
        <!-- Email Address -->

        <x-input.email id="email" :label="__('Email address')" placeholder="email@example.com" width="full" autocomplete="email"
            wire:model="email" color="primary" />

        <!-- Password -->
        <div class="relative">
            <x-input.password id="password" :label="__('Password')" :placeholder="__('Password')" width="full" :icon="true"
                wire:model="password" color="primary" />

            @if (Route::has('password.request'))
                <x-link href="{{ route('password.request') }}" label="{{ __('Forgot your password?') }}"
                    class="absolute end-0 top-0 text-sm hover:underline" />
            @endif
        </div>

        <!-- Remember Me -->
        <x-input.checkbox-group name="remember" wire:model="remember" :options="['remember_me' => __('Keep session active')]" shape="rounded"
            color="primary" />


        <div class="flex items-center justify-end">
            <x-button label="{{ __('Log in') }}" width="full" type="submit" color="primary" />
        </div>
    </form>

    @if (Route::has('register'))
        <div class="space-x-1 rtl:space-x-reverse text-center text-sm text-primary-600 dark:text-primary-400">
            <span>{{ __('Don\'t have an account?') }}</span>
            <x-link href="{{ route('register') }}" label="{{ __('Sign up') }}" class="hover:underline" />
        </div>
    @endif
</div>
