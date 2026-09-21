<x-guest-layout>
    <div class="text-center mb-6">
        <h1 class="text-lg font-bold text-brand-700 dark:text-brand-400">Connexion employé</h1>
    </div>

    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="mt-1" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="password" :value="__('Mot de passe')" />
            <x-text-input id="password" class="mt-1" type="password" name="password" required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="block mt-4">
            <label class="inline-flex items-center">
                <input type="checkbox" name="remember" class="rounded border-brand-300 text-brand-600 shadow-sm focus:ring-brand-500">
                <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">Se souvenir de moi</span>
            </label>
        </div>

        <div class="mt-6">
            <x-primary-button class="w-full justify-center py-2.5">Se connecter</x-primary-button>
        </div>

        <p class="text-center text-sm text-gray-600 dark:text-gray-400 mt-6">
            Pas encore de compte ? <a href="{{ route('register') }}" class="text-accent-700 dark:text-accent-400 font-medium hover:underline">Créer un compte employé</a>
        </p>
    </form>
</x-guest-layout>
