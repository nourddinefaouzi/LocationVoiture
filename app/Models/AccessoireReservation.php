<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccessoireReservation extends Model
{
    use HasFactory;

    protected $table = 'accessoire_reservation';

    protected $fillable = [
        'quantite',
        'accessoire_id',
        'reservation_id'
    ];

    public $timestamps = false;


}
