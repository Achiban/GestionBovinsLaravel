<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BovinController;
use App\Http\Controllers\EtableController;
use App\Http\Controllers\QuarantaineController;
use App\Http\Controllers\VendeurController;
use App\Http\Controllers\TransporteurController;
use App\Http\Controllers\VehiculeController;
use App\Http\Controllers\VetoController;
use App\Http\Controllers\MedicamentController;
use App\Http\Controllers\MedicConsommeController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\NourritureController;
use App\Http\Controllers\VisiteController;

use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return redirect()->route('bovins.index');
});

// Routes d'authentification
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Toutes les autres routes sont protégées par le middleware auth
Route::middleware(['auth'])->group(function () {
    Route::resource('etables', EtableController::class);
Route::resource('quarantaines', QuarantaineController::class);
Route::resource('vendeurs', VendeurController::class);
Route::resource('transporteurs', TransporteurController::class);
Route::resource('vehicules', VehiculeController::class);
Route::resource('vetos', VetoController::class);
Route::resource('medicaments', MedicamentController::class);
Route::resource('medic_consommes', MedicConsommeController::class)->only(['index', 'show', 'destroy']);
Route::resource('stocks', StockController::class);
Route::resource('nourritures', NourritureController::class)->only(['index', 'show', 'destroy']);
Route::resource('visites', VisiteController::class);

// Routes pour Bovins et actions spécifiques
Route::resource('bovins', BovinController::class);

    Route::post('bovins/{bovin}/vendre', [BovinController::class, 'vendre'])->name('bovins.vendre');
    Route::post('bovins/{bovin}/marquer-mort', [BovinController::class, 'marquerMort'])->name('bovins.marquerMort');
    Route::post('bovins/{bovin}/donner-medicament', [BovinController::class, 'donnerMedicament'])->name('bovins.donnerMedicament');
    Route::post('bovins/{bovin}/donner-alimentation', [BovinController::class, 'donnerAlimentation'])->name('bovins.donnerAlimentation');
});
