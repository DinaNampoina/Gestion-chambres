<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    public function index()
    {
        $enAttente = Reservation::with(['client', 'chambre'])
            ->where('statut', 'attente')
            ->orderBy('date_debut')
            ->get();

        $aujourdhui = now()->format('Y-m-d');

        $enCours = Reservation::with(['client', 'chambre'])
            ->where('statut', 'validee')
            ->where('date_debut', '<=', $aujourdhui)
            ->where('date_fin', '>=', $aujourdhui)
            ->orderBy('date_fin')
            ->get();

        return view('reservations.index', compact('enAttente', 'enCours'));
    }

    public function valider(Reservation $reservation)
    {
        $resultat = $reservation->validerAvecControle(Auth::id());

        return redirect()->route('reservations.index')->with($resultat['success'] ? 'success' : 'error', $resultat['message']);
    }

    public function refuser(Reservation $reservation)
    {
        $resultat = $reservation->refuserAvecControle(Auth::id());

        return redirect()->route('reservations.index')->with($resultat['success'] ? 'success' : 'error', $resultat['message']);
    }

    public function checkout(Reservation $reservation)
    {
        $resultat = $reservation->checkout();

        return redirect()->route('reservations.index')->with($resultat['success'] ? 'success' : 'error', $resultat['message']);
    }
}
