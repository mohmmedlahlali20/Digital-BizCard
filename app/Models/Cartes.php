<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cartes extends Model
{
    use HasFactory;

    protected $fillable =[
        'titre',
        'nom_entreprise'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
