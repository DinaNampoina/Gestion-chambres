<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200">Nouvelle location — Accueil</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-lg mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-brand-900 shadow-sm rounded-lg p-6">
                <form method="POST" action="{{ route('accueil.store') }}">
                    @csrf

                    <p class="text-sm font-semibold text-gray-600 dark:text-gray-400 mb-2">Client</p>
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
                        <x-text-input id="email" class="mt-1" type="email" name="email" :value="old('email')" required />
                        <p class="text-xs text-gray-500 mt-1">Si l'email existe déjà, le client existant sera utilisé.</p>
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <p class="text-sm font-semibold text-gray-600 dark:text-gray-400 mt-6 mb-2">Séjour</p>
                    <div>
                        <x-input-label for="chambre_id" :value="__('Chambre')" />
                        <select id="chambre_id" name="chambre_id" class="mt-1 w-full border-brand-200 dark:border-brand-700 dark:bg-brand-900 dark:text-gray-200 rounded-md shadow-sm focus:border-brand-500 focus:ring-brand-500" required>
                            <option value="">-- Choisir --</option>
                            @foreach ($chambres as $chambre)
                                <option value="{{ $chambre->id }}" {{ old('chambre_id') == $chambre->id ? 'selected' : '' }}>
                                    {{ $chambre->numero }} — {{ $chambre->type }} ({{ number_format($chambre->prix, 0, ',', ' ') }} Ar/nuit)
                                </option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('chambre_id')" class="mt-2" />
                    </div>
                    <div class="mt-4 grid grid-cols-2 gap-3">
                        <div>
                            <x-input-label for="date_debut" :value="__('Arrivée')" />
                            <x-text-input id="date_debut" class="mt-1" type="date" name="date_debut" :value="old('date_debut')" required />
                            <x-input-error :messages="$errors->get('date_debut')" class="mt-2" />
                        </div>
                        <div>
                            <x-input-label for="date_fin" :value="__('Départ')" />
                            <x-text-input id="date_fin" class="mt-1" type="date" name="date_fin" :value="old('date_fin')" required />
                            <x-input-error :messages="$errors->get('date_fin')" class="mt-2" />
                        </div>
                    </div>

                    <div class="flex justify-end gap-3 mt-6">
                        <a href="{{ route('dashboard') }}" class="text-sm text-gray-600 dark:text-gray-400 hover:underline">Annuler</a>
                        <x-primary-button>Créer la location</x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
