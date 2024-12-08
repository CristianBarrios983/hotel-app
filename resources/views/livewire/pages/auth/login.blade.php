<?php

use App\Livewire\Forms\LoginForm;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public LoginForm $form;

    /**
     * Handle an incoming authentication request.
     */
    public function login(): void
    {
        $this->validate();

        $this->form->authenticate();

        Session::regenerate();

        $this->redirectIntended(default: route('dashboard', absolute: false), navigate: true);
    }
}; ?>

<div>
    <div class="max-w-md w-full">
        <!-- Hotel Logo/Header -->
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-gray-900 dark:text-gray-100">Hotel Management</h1>
            <p class="text-gray-600 dark:text-gray-400 mt-2">Acceso al Sistema</p>
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form wire:submit="login">
            <!-- Email Address -->
            <div class="space-y-2">
                <x-input-label for="email" :value="__('Correo Electrónico')" />
                <x-text-input 
                    wire:model="form.email" 
                    id="email" 
                    class="block w-full px-4 py-3 rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500" 
                    type="email" 
                    name="email" 
                    required 
                    autofocus 
                    autocomplete="username" />
                <x-input-error :messages="$errors->get('form.email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-6 space-y-2">
                <x-input-label for="password" :value="__('Contraseña')" />
                <x-text-input 
                    wire:model="form.password" 
                    id="password" 
                    class="block w-full px-4 py-3 rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500"
                    type="password"
                    name="password"
                    required 
                    autocomplete="current-password" />
                <x-input-error :messages="$errors->get('form.password')" class="mt-2" />
            </div>

            <!-- Remember Me -->
            <div class="mt-6">
                <label for="remember" class="inline-flex items-center">
                    <input wire:model="form.remember" id="remember" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-blue-600 shadow-sm focus:ring-blue-500 dark:focus:ring-blue-600 dark:focus:ring-offset-gray-800" name="remember">
                    <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Recordar sesión') }}</span>
                </label>
            </div>

            <div class="mt-6 flex flex-col sm:flex-row items-center justify-between gap-3">
                @if (Route::has('password.request'))
                    <a class="text-sm text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300" href="{{ route('password.request') }}" wire:navigate>
                        {{ __('¿Olvidaste tu contraseña?') }}
                    </a>
                @endif

                <x-primary-button class="w-full sm:w-auto justify-center bg-blue-600 hover:bg-blue-700">
                    {{ __('Iniciar Sesión') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</div>
