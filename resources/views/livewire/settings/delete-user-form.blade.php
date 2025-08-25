<?php

use App\Livewire\Actions\Logout;
use Illuminate\Support\Facades\Auth;
use Livewire\Volt\Component;

new class extends Component {
    public string $password = '';

    /**
     * Delete the currently authenticated user.
     */
    public function deleteUser(Logout $logout): void
    {
        $this->validate([
            'password' => ['required', 'string', 'current_password'],
        ]);

        tap(Auth::user(), $logout(...))->delete();

        $this->redirect('/', navigate: true);
    }
}; ?>

<section class="mt-10 space-y-6">
    <x-layout.section 
        title="{{ __('Delete your account and all of its resources') }}">
        <x-modal name="confirm-user-deletion" :show="$errors->isNotEmpty()" focusable closeLabel="{{ __('Cancel') }}" color="danger"
            openLabel="{{ __('Delete account') }}" title="{{ __('Are you sure you want to delete your account?') }}">
            <form wire:submit="deleteUser" class="space-y-6">
                <div>
                    <p>
                        {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
                    </p>
                </div>

                <x-input.password wire:model="password" placeholder="{{ __('Password') }}" width="full" />

                <div class="flex justify-end space-x-2 rtl:space-x-reverse">
                    <x-button color="danger" type="submit" label="{{ __('Delete account') }}"/>
                    
                </div>
            </form>
        </x-modal>
    </x-layout.section>


</section>
