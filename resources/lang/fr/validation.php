<?php

return [
    'after' => 'Le champ :attribute doit être une date postérieure à :date.',
    'required' => 'Le champ :attribute est obligatoire.',
    'email' => 'Le champ :attribute doit être une adresse email valide.',
    'unique' => 'Cette valeur pour :attribute est déjà utilisée.',
    'min' => [
        'string' => 'Le champ :attribute doit contenir au moins :min caractères.',
        'numeric' => 'Le champ :attribute doit être au moins :min.',
    ],
    'max' => [
        'string' => 'Le champ :attribute ne doit pas dépasser :max caractères.',
        'numeric' => 'Le champ :attribute ne doit pas dépasser :max.',
    ],
    'numeric' => 'Le champ :attribute doit être un nombre.',
    'confirmed' => 'La confirmation de :attribute ne correspond pas.',
    'in' => 'La valeur sélectionnée pour :attribute est invalide.',
    'exists' => 'La valeur sélectionnée pour :attribute est invalide.',
    'date' => 'Le champ :attribute doit être une date valide.',
    'integer' => 'Le champ :attribute doit être un nombre entier.',

    'attributes' => [
        'nom' => 'nom',
        'prenom' => 'prénom',
        'email' => 'email',
        'password' => 'mot de passe',
        'numero' => 'numéro',
        'type' => 'type',
        'capacite' => 'capacité',
        'prix' => 'prix',
        'statut_actuel' => 'statut',
        'chambre_id' => 'chambre',
        'date_debut' => 'date d\'arrivée',
        'date_fin' => 'date de départ',
        'code_securite' => 'code de sécurité',
    ],
];
