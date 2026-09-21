<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <a href="{{ route('dashboard') }}" class="text-gray-500 dark:text-gray-400 hover:text-brand-600">&larr;</a>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200">Réservations</h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 space-y-8">

            <div>
                <h3 class="font-semibold text-gray-800 dark:text-gray-200 mb-3">En attente de validation</h3>
                <div class="space-y-3">
                    @forelse ($enAttente as $r)
                        <div class="bg-white dark:bg-brand-900 shadow-sm rounded-lg p-4 flex items-center gap-4">
                            <div class="flex-1">
                                <p class="font-semibold">{{ $r->client->prenom }} {{ $r->client->nom }}</p>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Chambre {{ $r->chambre->numero }} —
                                    du {{ \Illuminate\Support\Carbon::parse($r->date_debut)->format('d/m/Y') }} au
                                    {{ \Illuminate\Support\Carbon::parse($r->date_fin)->format('d/m/Y') }}</p>
                            </div>
                            <form action="{{ route('reservations.valider', $r) }}" method="POST">
                                @csrf
                                <button type="submit"
                                    class="px-3 py-1.5 bg-brand-600 hover:bg-brand-700 text-white rounded-md text-sm">Valider</button>
                            </form>
                            <form action="{{ route('reservations.refuser', $r) }}" method="POST"
                                onsubmit="return confirm('Refuser cette réservation ?')">
                                @csrf
                                <button type="submit"
                                    class="px-3 py-1.5 border border-red-300 text-red-600 rounded-md text-sm">Refuser</button>
                            </form>
                        </div>
                    @empty
                        <p class="text-gray-500 dark:text-gray-400">Aucune réservation en attente.</p>
                    @endforelse
                </div>
            </div>

            <div>
                <h3 class="font-semibold text-gray-800 dark:text-gray-200 mb-3">Séjours en cours</h3>
                <div class="space-y-3">
                    @forelse ($enCours as $r)
                        <div class="bg-white dark:bg-brand-900 shadow-sm rounded-lg p-4 flex items-center gap-4">
                            <div class="flex-1">
                                <p class="font-semibold">{{ $r->client->prenom }} {{ $r->client->nom }}</p>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Chambre {{ $r->chambre->numero }} —
                                    jusqu'au {{ \Illuminate\Support\Carbon::parse($r->date_fin)->format('d/m/Y') }}</p>
                            </div>
                            <form action="{{ route('reservations.checkout', $r) }}" method="POST"
                                onsubmit="return confirm('Confirmer le check-out ?')">
                                @csrf
                                <button type="submit"
                                    class="px-3 py-1.5 bg-accent-500 hover:bg-accent-600 text-accent-900 rounded-md text-sm font-medium">Check-out</button>
                            </form>
                        </div>
                    @empty
                        <p class="text-gray-500 dark:text-gray-400">Aucun séjour en cours.</p>
                    @endforelse
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
