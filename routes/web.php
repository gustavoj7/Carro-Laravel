<?php

use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\ColorController;
use App\Http\Controllers\Admin\VehicleController as AdminVehicleController;
use App\Http\Controllers\Admin\VehicleModelController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublicVehicleController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PublicVehicleController::class, 'index'])->name('site.home');
Route::get('/veiculos/{vehicle}', [PublicVehicleController::class, 'show'])->name('site.vehicles.show');

Route::get('/dashboard', function () {
    return redirect()->route('admin.vehicles.index');
})->middleware(['auth', 'verified', 'admin'])->name('dashboard');

Route::middleware(['auth', 'verified', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/', fn () => redirect()->route('admin.vehicles.index'))->name('home');
        Route::resource('brands', BrandController::class)->except('show');
        Route::resource('vehicle-models', VehicleModelController::class)->except('show');
        Route::resource('colors', ColorController::class)->except('show');
        Route::resource('vehicles', AdminVehicleController::class);
    });

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
