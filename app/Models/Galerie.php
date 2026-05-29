<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Galerie extends Model
{
    protected $table = 'galerie';

    protected $fillable = [
        'titlu',
        'descriere',
        'imagine',
        'categorie_id',
        'ordine_afisare',
        'activ',
    ];

    protected $casts = [
        'activ' => 'boolean',
        'ordine_afisare' => 'integer',
    ];

    public function categorie(): BelongsTo
    {
        return $this->belongsTo(Categorie::class, 'categorie_id');
    }
}
