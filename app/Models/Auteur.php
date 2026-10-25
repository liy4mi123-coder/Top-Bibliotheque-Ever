<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Auteur extends Model

{
    public function livres()
{
    return $this->hasMany(Livre::class);
}
    protected $fillable = [
        'nom',
        'prenom',
        'email',
        'date_naissance',
        'nationalite',
        'actif',
    ];

    protected $casts = [
        'date_naissance' => 'date',
        'actif' => 'boolean',
    ];
}