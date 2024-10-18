<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Charge extends Model
{
    use HasFactory;

    protected $fillable = [
        'montant',
        'date',
        'motif',
        'voiture_id'
    ];

    public $timestamps = false;

    public function voiture(){
        return $this->belongsTo(Voiture::class);
    }
}
