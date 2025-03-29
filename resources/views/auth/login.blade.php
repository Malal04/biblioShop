<x-guest-layout>
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <h2 class="auth__title">
            Connexion a BiblioShop
        </h2>
        
        <div class="auth__input">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" />
        </div>

        <div class="auth__input">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" type="password" name="password" required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" />
        </div>

        <div class="auth__link_sect" style="margin-bottom: 10px;">
            <a class="auth_link" href="{{ route('password.request') }}">
                {{ __('Mot de passe oublié ?') }}
            </a>
        </div>

        <div class="auth_button">
            @if (Route::has('password.request'))
            <x-primary-button class="auth_button">
                {{ __('Se connecter') }}
            </x-primary-button>
            @endif
        </div>

        <div class="auth__link_sec" style="margin-top: 10px;">
            <a class="auth_link" href="{{ route('register') }}">
                {{ __('Pas encore de compte ?') }}
            </a>
        </div>

    </form>

</x-guest-layout>
