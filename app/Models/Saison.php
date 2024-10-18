<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Saison extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom', 
        'debutSaison',
        'finSaison'
    ];

    public $timestamps = false;

    public function prices(){
        return $this->hasMany(Price::class);
    }
}
