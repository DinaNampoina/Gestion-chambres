<?php

use App\Http\Controllers\AccueilController;
use App\Http\Controllers\ChambreController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReservationController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route(auth()->check() ? 'dashboard' : 'login');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('chambres', ChambreController::class)->except(['show']);

    Route::get('reservations', [ReservationController::class, 'index'])->name('reservations.index');
    Route::post('reservations/{reservation}/valider', [ReservationController::class, 'valider'])->name('reservations.valider');
    Route::post('reservations/{reservation}/refuser', [ReservationController::class, 'refuser'])->name('reservations.refuser');
    Route::post('reservations/{reservation}/checkout', [ReservationController::class, 'checkout'])->name('reservations.checkout');

    Route::get('accueil', [AccueilController::class, 'create'])->name('accueil.create');
    Route::post('accueil', [AccueilController::class, 'store'])->name('accueil.store');
});

require __DIR__.'/auth.php';
