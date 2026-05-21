<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Categorie extends Model
{
    protected $table = 'categorii';

    protected $fillable = [
        'slug',
        'denumire',
        'descriere_scurta',
        'descriere_completa',
        'imagine',
        'ordine_afisare',
        'activ',
    ];

    protected $casts = [
        'activ' => 'boolean',
        'ordine_afisare' => 'integer',
    ];

    public function produse(): HasMany
    {
        return $this->hasMany(Produs::class, 'categorie_id');
    }

    public function produseActive(): HasMany
    {
        return $this->hasMany(Produs::class, 'categorie_id')->where('activ', true);
    }
}
