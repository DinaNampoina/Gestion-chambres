<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = ['client_id', 'user_id', 'chambre_id', 'date_debut', 'date_fin', 'statut'];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function chambre()
    {
        return $this->belongsTo(Chambre::class);
    }

    public static function plageValide(string $debut, string $fin): bool
    {
        return $debut < $fin;
    }

    /**
     * Séjours traités comme intervalles [arrivée, départ[.
     */
    public static function estDisponible(
        int $chambreId,
        string $debut,
        string $fin,
        ?int $exclureId = null,
        array $statutsBloquants = ['attente', 'validee']
    ): bool {
        if (! self::plageValide($debut, $fin)) {
            return false;
        }

        $query = self::where('chambre_id', $chambreId)
            ->whereIn('statut', $statutsBloquants)
            ->where('date_debut', '<', $fin)
            ->where('date_fin', '>', $debut);

        if ($exclureId !== null) {
            $query->where('id', '!=', $exclureId);
        }

        return $query->count() === 0;
    }

    public static function creerAccueil(array $data): array
    {
        if (! self::plageValide($data['date_debut'], $data['date_fin'])) {
            return ['success' => false, 'message' => "La date de départ doit être postérieure à la date d'arrivée."];
        }

        $chambre = Chambre::find($data['chambre_id']);

        if (! $chambre) {
            return ['success' => false, 'message' => 'Chambre introuvable.'];
        }

        if ($chambre->statut_actuel === 'maintenance') {
            return ['success' => false, 'message' => 'Cette chambre est actuellement en maintenance.'];
        }

        if (! self::estDisponible($data['chambre_id'], $data['date_debut'], $data['date_fin'])) {
            return ['success' => false, 'message' => "La chambre n'est pas disponible pour ces dates."];
        }

        $reservation = self::create($data);

        $aujourdhui = now()->format('Y-m-d');
        if ($data['date_debut'] <= $aujourdhui && $data['date_fin'] >= $aujourdhui) {
            $chambre->update(['statut_actuel' => 'occupee']);
        }

        return ['success' => true, 'message' => 'Location créée avec succès.', 'reservation' => $reservation];
    }

    public function validerAvecControle(int $userId): array
    {
        if ($this->statut !== 'attente') {
            return ['success' => false, 'message' => 'Cette réservation a déjà été traitée.'];
        }

        if (! self::estDisponible($this->chambre_id, $this->date_debut, $this->date_fin, $this->id, ['validee'])) {
            return ['success' => false, 'message' => 'Impossible de valider : la chambre est déjà réservée sur cette période.'];
        }

        $this->update(['statut' => 'validee', 'user_id' => $userId]);

        $aujourdhui = now()->format('Y-m-d');
        if ($this->date_debut <= $aujourdhui && $this->date_fin >= $aujourdhui) {
            $this->chambre->update(['statut_actuel' => 'occupee']);
        }

        return ['success' => true, 'message' => 'Réservation validée avec succès.'];
    }

    public function refuserAvecControle(int $userId): array
    {
        if ($this->statut !== 'attente') {
            return ['success' => false, 'message' => 'Cette réservation a déjà été traitée.'];
        }

        $this->update(['statut' => 'annulee', 'user_id' => $userId]);

        return ['success' => true, 'message' => 'Réservation refusée.'];
    }

    public function checkout(): array
    {
        if ($this->statut !== 'validee') {
            return ['success' => false, 'message' => 'Le check-out est seulement possible pour une réservation validée.'];
        }

        $this->update(['statut' => 'terminee']);
        $this->chambre->update(['statut_actuel' => 'libre']);

        return ['success' => true, 'message' => 'Check-out effectué avec succès.'];
    }
}
