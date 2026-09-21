<?php

namespace App\Http\Controllers;

use App\Models\Chambre;
use Illuminate\Http\Request;

class ChambreController extends Controller
{
    public function index()
    {
        $chambres = Chambre::orderBy('numero')->get();

        return view('chambres.index', compact('chambres'));
    }

    public function create()
    {
        return view('chambres.create');
    }

    public function store(Request $request)
    {
        $validated = $this->validated($request);

        Chambre::create($validated);

        return redirect()->route('chambres.index')->with('success', 'Chambre ajoutée avec succès.');
    }

    public function edit(Chambre $chambre)
    {
        return view('chambres.edit', compact('chambre'));
    }

    public function update(Request $request, Chambre $chambre)
    {
        $validated = $this->validated($request, $chambre->id);

        $chambre->update($validated);

        return redirect()->route('chambres.index')->with('success', 'Chambre modifiée avec succès.');
    }

    public function destroy(Chambre $chambre)
    {
        if ($chambre->aReservationActive()) {
            return redirect()->route('chambres.index')->with('error', 'Suppression impossible : cette chambre possède une réservation active.');
        }

        $chambre->delete();

        return redirect()->route('chambres.index')->with('success', 'Chambre supprimée avec succès.');
    }

    private function validated(Request $request, ?int $ignoreId = null): array
    {
        return $request->validate([
            'numero' => ['required', 'string', 'max:50', 'unique:chambres,numero' . ($ignoreId ? ",{$ignoreId}" : '')],
            'type' => ['required', 'string', 'max:30'],
            'capacite' => ['required', 'integer', 'min:1'],
            'prix' => ['required', 'numeric', 'min:0.01'],
            'statut_actuel' => ['required', 'in:libre,occupee,maintenance'],
        ]);
    }
}
