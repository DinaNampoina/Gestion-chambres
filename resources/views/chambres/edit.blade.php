<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <a href="{{ route('chambres.index') }}" class="text-gray-500 dark:text-gray-400 hover:text-brand-600">&larr;</a>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200">Modifier la chambre</h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-md mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-brand-900 shadow-sm rounded-lg p-6">
                <form method="POST" action="{{ route('chambres.update', $chambre) }}">
                    @csrf
                    @method('PUT')
                    @include('chambres._form')
                    <div class="flex justify-end gap-3 mt-6">
                        <a href="{{ route('chambres.index') }}" class="text-sm text-gray-600 dark:text-gray-400 hover:underline">Annuler</a>
                        <x-primary-button>Mettre à jour</x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
