<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Produs extends Model
{
    protected $table = 'produse';

    protected $fillable = [
        'categorie_id',
        'denumire',
        'descriere',
        'imagine',
        'pret_de_la',
        'caracteristici',
        'activ',
    ];

    protected $casts = [
        'caracteristici' => 'array',
        'pret_de_la' => 'decimal:2',
        'activ' => 'boolean',
    ];

    public function categorie(): BelongsTo
    {
        return $this->belongsTo(Categorie::class, 'categorie_id');
    }
}
