<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\LeaveController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\IsAdmin;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    // Routes du profil (Générées par Breeze)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Routes Employés
    Route::resource('employees', EmployeeController::class);

    // Routes Congés
    Route::resource('leaves', LeaveController::class);
    
    // Routes personnalisées pour Valider/Refuser (Doivent être explicites)
    Route::put('/leaves/{leave}/approve', [LeaveController::class, 'approve'])->name('leaves.approve');
    Route::put('/leaves/{leave}/reject', [LeaveController::class, 'reject'])->name('leaves.reject');
    
    
});

// On crée un groupe protégé. 
// Si l'utilisateur n'est pas "admin", il prend une erreur 403.
Route::middleware(['auth', IsAdmin::class])->group(function () {
    Route::resource('employees', EmployeeController::class);
});

require __DIR__.'/auth.php';