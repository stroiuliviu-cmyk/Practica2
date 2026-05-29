<?php

use App\Http\Controllers\Admin\CategorieController as AdminCategorieController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\GalerieController as AdminGalerieController;
use App\Http\Controllers\Admin\MesajContactController as AdminMesajContactController;
use App\Http\Controllers\Admin\NewsletterController as AdminNewsletterController;
use App\Http\Controllers\Admin\ProdusController as AdminProdusController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ContacteController;
use App\Http\Controllers\DespreController;
use App\Http\Controllers\GalerieController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\ServiciuController;
use Illuminate\Support\Facades\Route;

// ============================
// Rute publice
// ============================
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/despre', [DespreController::class, 'index'])->name('despre');

Route::get('/servicii', [ServiciuController::class, 'index'])->name('servicii.index');
Route::get('/cautare', [ServiciuController::class, 'search'])->name('servicii.search');
Route::get('/servicii/{slug}', [ServiciuController::class, 'show'])->name('servicii.show');

Route::get('/galerie', [GalerieController::class, 'index'])->name('galerie.index');

Route::get('/contacte', [ContacteController::class, 'index'])->name('contacte.index');
Route::post('/contacte', [ContacteController::class, 'store'])->name('contacte.store');

Route::post('/newsletter', [NewsletterController::class, 'subscribe'])->name('newsletter.subscribe');

// ============================
// Autentificare (doar login + logout — fără register public)
// ============================
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'show'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.attempt');
});

Route::post('/logout', [LoginController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

// ============================
// Panou admin (protejat de middleware 'admin')
// ============================
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');

    Route::resource('categorii', AdminCategorieController::class);
    Route::resource('produse', AdminProdusController::class);
    Route::resource('galerie', AdminGalerieController::class);

    Route::get('mesaje', [AdminMesajContactController::class, 'index'])->name('mesaje.index');
    Route::get('mesaje/{mesaj}', [AdminMesajContactController::class, 'show'])->name('mesaje.show');
    Route::patch('mesaje/{mesaj}/toggle-citit', [AdminMesajContactController::class, 'toggleCitit'])->name('mesaje.toggleCitit');
    Route::delete('mesaje/{mesaj}', [AdminMesajContactController::class, 'destroy'])->name('mesaje.destroy');

    Route::get('newsletter', [AdminNewsletterController::class, 'index'])->name('newsletter.index');
    Route::delete('newsletter/{subscriber}', [AdminNewsletterController::class, 'destroy'])->name('newsletter.destroy');
});
