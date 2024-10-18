<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'Tel',
        'Permis',
        'Adresse',
        'cin',
        'passport',
        'user_id'
    ];

    public $timestamps = false;

    public function user(){
        return $this->belongsTo(User::class);
    }


}
