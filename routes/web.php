<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InstallController;
use App\Http\Controllers\LeadController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => redirect()->route('dashboard'));

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.store');
    Route::get('/setup', [InstallController::class, 'show'])->name('setup');
    Route::post('/setup', [InstallController::class, 'store'])->name('setup.store');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/app', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('leads', LeadController::class)->except(['create']);
    Route::get('/leads/create', [LeadController::class, 'create'])->name('leads.create');
});

Route::get('/up', fn () => response()->json(['status' => 'ok']));
