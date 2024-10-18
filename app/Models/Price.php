<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    use HasFactory;

    protected $fillable = [
        'minJoursReservation',
        'maxJoursReservation',
        'prix',
        'voiture_id',
        'saison_id'
    ];

    public $timestamps = false;

    public function saison(){
        return $this->belongsTo(Saison::class);
    }

    public function voiture(){
        return $this->belongsTo(Voiture::class);
    }
}
