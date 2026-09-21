<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Chambre extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['numero', 'type', 'capacite', 'prix', 'statut_actuel'];

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    public function aReservationActive(): bool
    {
        return $this->reservations()->whereIn('statut', ['attente', 'validee'])->exists();
    }
}
