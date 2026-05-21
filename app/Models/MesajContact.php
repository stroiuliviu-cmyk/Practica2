<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MesajContact extends Model
{
    protected $table = 'mesaje_contact';

    protected $fillable = [
        'nume',
        'email',
        'telefon',
        'subiect',
        'mesaj',
        'citit',
    ];

    protected $casts = [
        'citit' => 'boolean',
    ];
}
