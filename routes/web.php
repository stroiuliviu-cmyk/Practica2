<?php

use App\Http\Controllers\ContacteController;
use App\Http\Controllers\DespreController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ServiciuController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/despre', [DespreController::class, 'index'])->name('despre');

Route::get('/servicii', [ServiciuController::class, 'index'])->name('servicii.index');
Route::get('/servicii/{slug}', [ServiciuController::class, 'show'])->name('servicii.show');

Route::get('/contacte', [ContacteController::class, 'index'])->name('contacte.index');
Route::post('/contacte', [ContacteController::class, 'store'])->name('contacte.store');
