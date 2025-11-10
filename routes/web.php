<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KelasController;
// AuthController removed; login feature disabled

Route::get('/', function () {
    return view('dashboard');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->name('dashboard');

// Login feature removed. Routes that previously required auth will no longer redirect to a login page.

// Kelas (student view) - public route (auth disabled)
Route::get('/kelas', [KelasController::class, 'index'])
    ->name('kelas');

Route::get('/tugas', function () {
    return view('tugas.index');
})->name('tugas');

Route::get('/nilai', function () {
    return view('nilai.index');
})->name('nilai');

Route::get('/kelas/{id}', [KelasController::class, 'show'])
    ->name('kelas.detail');
