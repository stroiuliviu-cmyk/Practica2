<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NewsletterSubscriber extends Model
{
    protected $fillable = [
        'email',
        'activ',
        'confirmat_la',
    ];

    protected $casts = [
        'activ' => 'boolean',
        'confirmat_la' => 'datetime',
    ];
}
