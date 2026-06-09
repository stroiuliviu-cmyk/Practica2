<?php

// Teste unitare pentru modele — verifică fillable, casts, relații.

use App\Models\Categorie;
use App\Models\Galerie;
use App\Models\MesajContact;
use App\Models\Produs;
use App\Models\User;

it('Categorie are casts corecte', function () {
    $model = new Categorie();
    expect($model->getCasts())->toMatchArray([
        'activ' => 'boolean',
        'ordine_afisare' => 'integer',
    ]);
});

it('Produs are caracteristici ca array', function () {
    $model = new Produs();
    expect($model->getCasts()['caracteristici'])->toBe('array');
});

it('Categorie are relația hasMany produse', function () {
    $cat = new Categorie();
    $rel = $cat->produse();
    expect($rel)->toBeInstanceOf(\Illuminate\Database\Eloquent\Relations\HasMany::class);
});

it('Produs are relația belongsTo categorie', function () {
    $prod = new Produs();
    $rel = $prod->categorie();
    expect($rel)->toBeInstanceOf(\Illuminate\Database\Eloquent\Relations\BelongsTo::class);
});

it('Galerie are relația belongsTo categorie', function () {
    $g = new Galerie();
    $rel = $g->categorie();
    expect($rel)->toBeInstanceOf(\Illuminate\Database\Eloquent\Relations\BelongsTo::class);
});

it('MesajContact are citit ca boolean', function () {
    $m = new MesajContact();
    expect($m->getCasts()['citit'])->toBe('boolean');
});

it('User isAdmin() returnează boolean', function () {
    $admin = new User(['rol' => 'admin']);
    $editor = new User(['rol' => 'editor']);
    expect($admin->isAdmin())->toBeTrue();
    expect($editor->isAdmin())->toBeFalse();
});

it('Categorie folosește tabela categorii', function () {
    expect((new Categorie())->getTable())->toBe('categorii');
});

it('Produs folosește tabela produse', function () {
    expect((new Produs())->getTable())->toBe('produse');
});

it('MesajContact folosește tabela mesaje_contact', function () {
    expect((new MesajContact())->getTable())->toBe('mesaje_contact');
});
