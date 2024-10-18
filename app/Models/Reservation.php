<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $casts = [
        'debutReservation' => 'datetime',
        'finReservation' => 'datetime',
    ];
    
    protected $fillable = [
        'debutReservation',
        'finReservation',
        'statut',
        'client_id',
        'voiture_id',
        'secondDriver',
        'codeContrat',
        'prixVoiture',
        'pickUp',
        'dropOff',
        'total',
    ];

    public $timestamps = false;

    public function client(){
        return $this->belongsTo(Client::class);
    }

    public function voiture(){
        return $this->belongsTo(Voiture::class);
    }

    public function accessoires(){
        return $this->belongsToMany(Accessoire::class)->withPivot('quantite');
    }
}
