<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Livre extends Model
{
    public function auteur()
{
    return $this->belongsTo(Auteur::class);
}
    protected $fillable = [
        'auteur_id',
        'titre',
        'isbn',
        'prix',
        'stock',
        'date_publication',
        'disponible',
    ];

    protected $casts = [
        'prix' => 'decimal:2',
        'date_publication' => 'date',
        'disponible' => 'boolean',
    ];
}