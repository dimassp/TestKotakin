<?php

use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\RoleController;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

// Route::middleware('guest')->group(function() {
// });
Route::get('/', [LandingPageController::class, 'index'])->name('home');

Route::middleware(['auth', 'verified'])->group(function() {
    Route::get("/no_access", function() {
        return Inertia::render('NoAccess');
    })->name('no_access');

    Route::get('dashboard', function () {
        if(!Auth::user()->checkAccess(Role::ACCESS_DASHBOARD)) {
            return redirect()->route('no_access');
        }
        return Inertia::render('Dashboard');
    })->name('dashboard');
    
    Route::prefix('role')->group(function() {
        Route::get('/', [RoleController::class, 'index'])->name('role.index');
        Route::post('/store', [RoleController::class, 'store'])->name('role.store');
        Route::get('/create', [RoleController::class, 'create'])->name('role.create');
        Route::get('/search', [RoleController::class, 'search'])->name('role.search');
        Route::get('/edit/{id}', [RoleController::class, 'edit'])->name('role.edit');
        Route::get('/{id}', [RoleController::class, 'detail'])->name('role.detail');
        Route::delete('/{id}', [RoleController::class, 'delete'])->name('role.delete');
        Route::patch('/{id}', [RoleController::class, 'update'])->name('role.update');
    });
    
});

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
