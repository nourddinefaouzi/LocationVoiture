<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Accessoire extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'description',
        'image',
        'quantite',
        'max',
        'prix',
        'prixType'
    ];

    public $timestamps = false;

    public function reservations(){
        return $this->belongsToMany(Reservation::class)->withPivot('quantite');
    }
}
