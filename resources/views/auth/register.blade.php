<x-guest-layout>
    <div class="text-center mb-6">
        <h1 class="text-lg font-bold text-brand-700 dark:text-brand-400">Créer un compte employé</h1>
        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Un code de sécurité fourni par l'administration est requis</p>
    </div>

    <form method="POST" action="{{ route('register') }}">
        @csrf
        <div>
            <x-input-label for="nom" :value="__('Nom')" />
            <x-text-input id="nom" class="mt-1" type="text" name="nom" :value="old('nom')" required autofocus />
            <x-input-error :messages="$errors->get('nom')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="prenom" :value="__('Prénom')" />
            <x-text-input id="prenom" class="mt-1" type="text" name="prenom" :value="old('prenom')" required />
            <x-input-error :messages="$errors->get('prenom')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="mt-1" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="password" :value="__('Mot de passe')" />
            <x-text-input id="password" class="mt-1" type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirmer le mot de passe')" />
            <x-text-input id="password_confirmation" class="mt-1" type="password" name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="code_securite" :value="__('Code de sécurité')" />
            <x-text-input id="code_securite" class="mt-1" type="text" name="code_securite" :value="old('code_securite')" required />
            <x-input-error :messages="$errors->get('code_securite')" class="mt-2" />
        </div>

        <div class="mt-6">
            <x-primary-button class="w-full justify-center py-2.5">Créer mon compte</x-primary-button>
        </div>

        <p class="text-center text-sm text-gray-600 dark:text-gray-400 mt-6">
            Déjà inscrit ? <a href="{{ route('login') }}" class="text-accent-700 dark:text-accent-400 font-medium hover:underline">Se connecter</a>
        </p>
    </form>
</x-guest-layout>
