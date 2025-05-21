<?php

use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::middleware('guest')->group(function() {
    Route::get('/', [LandingPageController::class, 'index'])->name('home');
});

Route::middleware(['auth', 'verified'])->group(function() {
    Route::get('dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
    
    Route::prefix('role')->group(function() {
        Route::get('/', [RoleController::class, 'index'])->name('role.index');
    });
    
});
// Route::get('dashboard', function () {
//     return Inertia::render('Dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');
// })->middleware('verified')->name('dashboard');

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
