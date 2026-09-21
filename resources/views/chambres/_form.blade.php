@php $chambre = $chambre ?? null; @endphp

<div>
    <x-input-label for="numero" :value="__('Numéro')" />
    <x-text-input id="numero" class="mt-1" type="text" name="numero" :value="old('numero', $chambre->numero ?? '')" required autofocus />
    <x-input-error :messages="$errors->get('numero')" class="mt-2" />
</div>

<div class="mt-4">
    <x-input-label for="type" :value="__('Type')" />
    <select id="type" name="type" class="mt-1 w-full border-brand-200 dark:border-brand-700 dark:bg-brand-900 dark:text-gray-200 rounded-md shadow-sm focus:border-brand-500 focus:ring-brand-500" required>
        @foreach(['Simple', 'Double', 'Suite', 'Familiale'] as $type)
            <option value="{{ $type }}" {{ old('type', $chambre->type ?? '') === $type ? 'selected' : '' }}>{{ $type }}</option>
        @endforeach
    </select>
    <x-input-error :messages="$errors->get('type')" class="mt-2" />
</div>

<div class="mt-4">
    <x-input-label for="capacite" :value="__('Capacité (personnes)')" />
    <x-text-input id="capacite" class="mt-1" type="number" name="capacite" min="1" :value="old('capacite', $chambre->capacite ?? '')" required />
    <x-input-error :messages="$errors->get('capacite')" class="mt-2" />
</div>

<div class="mt-4">
    <x-input-label for="prix" :value="__('Prix par nuit (Ar)')" />
    <x-text-input id="prix" class="mt-1" type="number" step="0.01" min="0" name="prix" :value="old('prix', $chambre->prix ?? '')" required />
    <x-input-error :messages="$errors->get('prix')" class="mt-2" />
</div>

<div class="mt-4">
    <x-input-label for="statut_actuel" :value="__('Statut')" />
    <select id="statut_actuel" name="statut_actuel" class="mt-1 w-full border-brand-200 dark:border-brand-700 dark:bg-brand-900 dark:text-gray-200 rounded-md shadow-sm focus:border-brand-500 focus:ring-brand-500" required>
        @foreach(['libre' => 'Libre', 'occupee' => 'Occupée', 'maintenance' => 'Maintenance'] as $value => $label)
            <option value="{{ $value }}" {{ old('statut_actuel', $chambre->statut_actuel ?? 'libre') === $value ? 'selected' : '' }}>{{ $label }}</option>
        @endforeach
    </select>
    <x-input-error :messages="$errors->get('statut_actuel')" class="mt-2" />
</div>
