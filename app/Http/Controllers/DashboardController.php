<?php

namespace App\Http\Controllers;

use App\Models\Reservation;

class DashboardController extends Controller
{
    public function index()
    {
        $enAttente = Reservation::where('statut', 'attente')->count();

        $arriveesAujourdhui = Reservation::with(['client', 'chambre'])
            ->where('statut', 'validee')
            ->where('date_debut', now()->format('Y-m-d'))
            ->orderBy('chambre_id')
            ->get();

        $chambresLibres = \App\Models\Chambre::where('statut_actuel', 'libre')->count();
        $chambresOccupees = \App\Models\Chambre::where('statut_actuel', 'occupee')->count();

        return view('dashboard', compact('enAttente', 'arriveesAujourdhui', 'chambresLibres', 'chambresOccupees'));
    }
}
