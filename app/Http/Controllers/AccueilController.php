<?php

namespace App\Http\Controllers;

use App\Models\Chambre;
use App\Models\Client;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AccueilController extends Controller
{
    public function create()
    {
        $chambres = Chambre::where('statut_actuel', '!=', 'maintenance')->orderBy('numero')->get();

        return view('accueil.create', compact('chambres'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => ['required', 'string', 'max:50'],
            'prenom' => ['required', 'string', 'max:50'],
            'email' => ['required', 'email', 'max:100'],
            'chambre_id' => ['required', 'exists:chambres,id'],
            'date_debut' => ['required', 'date'],
            'date_fin' => ['required', 'date', 'after:date_debut'],
        ]);

        return DB::transaction(function () use ($request) {
            $client = Client::firstOrCreate(
                ['email' => strtolower($request->email)],
                ['nom' => $request->nom, 'prenom' => $request->prenom]
            );

            $resultat = Reservation::creerAccueil([
                'client_id' => $client->id,
                'chambre_id' => $request->chambre_id,
                'user_id' => Auth::id(),
                'date_debut' => $request->date_debut,
                'date_fin' => $request->date_fin,
                'statut' => 'validee',
            ]);

            if (! $resultat['success']) {
                return back()->withInput()->with('error', $resultat['message']);
            }

            return redirect()->route('reservations.index')->with('success', $resultat['message']);
        });
    }
}
