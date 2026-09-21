<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200">Gestion des chambres</h2>
            <a href="{{ route('chambres.create') }}" class="px-4 py-2 bg-brand-600 hover:bg-brand-700 text-white rounded-md text-sm">+ Ajouter une chambre</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-brand-900 shadow-sm rounded-lg overflow-hidden">
                <table class="w-full text-sm table-fixed">
                    <thead class="bg-brand-50 dark:bg-brand-800">
                        <tr>
                            <th class="w-1/6 px-4 py-3 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase">Numéro</th>
                            <th class="w-1/6 px-4 py-3 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase">Type</th>
                            <th class="w-1/6 px-4 py-3 text-center text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase">Capacité</th>
                            <th class="w-1/6 px-4 py-3 text-center text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase">Prix/nuit</th>
                            <th class="w-1/6 px-4 py-3 text-center text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase">Statut</th>
                            <th class="w-1/6 px-4 py-3 text-right text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-brand-100 dark:divide-brand-800">
                        @foreach ($chambres as $chambre)
                            <tr>
                                <td class="px-4 py-3">{{ $chambre->numero }}</td>
                                <td class="px-4 py-3">{{ $chambre->type }}</td>
                                <td class="px-4 py-3 text-center">{{ $chambre->capacite }}</td>
                                <td class="px-4 py-3 text-center">{{ number_format($chambre->prix, 0, ',', ' ') }} Ar</td>
                                <td class="px-4 py-3 text-center">
                                    <span class="text-xs px-2 py-1 rounded
                                        @if($chambre->statut_actuel === 'libre') bg-brand-100 text-brand-700 dark:bg-brand-800 dark:text-brand-200
                                        @elseif($chambre->statut_actuel === 'occupee') bg-accent-100 text-accent-800 dark:bg-accent-900/40 dark:text-accent-300
                                        @else bg-gray-200 text-gray-600 dark:bg-gray-700 dark:text-gray-300 @endif">
                                        {{ $chambre->statut_actuel }}
                                    </span>
                                </td>
                                <td class="px-4 py-3 text-right">
                                    <div class="flex justify-end gap-3">
                                        <a href="{{ route('chambres.edit', $chambre) }}" class="text-accent-700 dark:text-accent-400 hover:underline">Modifier</a>
                                        <form action="{{ route('chambres.destroy', $chambre) }}" method="POST" onsubmit="return confirm('Supprimer cette chambre ?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:underline">Supprimer</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
