<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200">Tableau de bord</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="grid grid-cols-1 sm:grid-cols-4 gap-4">
                <div class="bg-white dark:bg-brand-900 shadow-sm rounded-lg p-6 text-center">
                    <p class="text-3xl font-bold text-accent-600 dark:text-accent-400">{{ $enAttente }}</p>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Réservations en attente</p>
                </div>
                <div class="bg-white dark:bg-brand-900 shadow-sm rounded-lg p-6 text-center">
                    <p class="text-3xl font-bold text-brand-600 dark:text-brand-400">{{ $arriveesAujourdhui->count() }}</p>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Arrivées aujourd'hui</p>
                </div>
                <div class="bg-white dark:bg-brand-900 shadow-sm rounded-lg p-6 text-center">
                    <p class="text-3xl font-bold text-brand-600 dark:text-brand-400">{{ $chambresLibres }}</p>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Chambres libres</p>
                </div>
                <div class="bg-white dark:bg-brand-900 shadow-sm rounded-lg p-6 text-center">
                    <p class="text-3xl font-bold text-gray-500 dark:text-gray-400">{{ $chambresOccupees }}</p>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Chambres occupées</p>
                </div>
            </div>

            <div class="bg-white dark:bg-brand-900 shadow-sm rounded-lg p-6 flex flex-wrap gap-3">
                <a href="{{ route('accueil.create') }}" class="px-4 py-2 bg-brand-600 hover:bg-brand-700 text-white rounded-md text-sm">+ Nouvelle location (accueil)</a>
                <a href="{{ route('reservations.index') }}" class="px-4 py-2 border border-accent-400 text-accent-700 dark:text-accent-400 rounded-md text-sm hover:bg-accent-50 dark:hover:bg-brand-800">Voir les réservations</a>
                <a href="{{ route('chambres.index') }}" class="px-4 py-2 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 rounded-md text-sm hover:bg-gray-50 dark:hover:bg-brand-800">Gérer les chambres</a>
            </div>

            <div class="bg-white dark:bg-brand-900 shadow-sm rounded-lg overflow-hidden">
                <div class="px-6 py-4 border-b border-brand-100 dark:border-brand-800 font-semibold text-gray-800 dark:text-gray-200">Arrivées du jour</div>
                @forelse ($arriveesAujourdhui as $r)
                    <div class="px-6 py-3 border-b border-brand-50 dark:border-brand-800 flex justify-between">
                        <span>{{ $r->client->prenom }} {{ $r->client->nom }}</span>
                        <span class="text-gray-500 dark:text-gray-400">Chambre {{ $r->chambre->numero }}</span>
                    </div>
                @empty
                    <p class="px-6 py-4 text-gray-500 dark:text-gray-400">Aucune arrivée prévue aujourd'hui.</p>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
