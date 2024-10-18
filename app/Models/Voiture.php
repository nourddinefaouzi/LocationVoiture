<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voiture extends Model
{
    use HasFactory;

    protected $fillable = [
        'marque',
        'modele',
        'couleur',
        'immatriculation',
        'carburant',
        'puissance',
        'kilometrage',
        'statut'
    ];

    public $timestamps = false;

    public function prices(){
        return $this->hasMany(Price::class);
    }

    public function photos(){
        return $this->hasMany(Photo::class);
    }

    public function reservations(){
        return $this->hasMany(Reservation::class);
    }

    public function charges(){
        return $this->hasMany(Charge::class);
    }
}
