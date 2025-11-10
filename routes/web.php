<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\TugasController;
use App\Http\Controllers\NilaiController;

Route::get('/', function () {
    return view('dashboard');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->name('dashboard');

// Kelas (student view) - public route (auth disabled)
Route::get('/kelas', [KelasController::class, 'index'])
    ->name('kelas');

Route::get('/tugas', [TugasController::class, 'index'])
    ->name('tugas');

Route::get('/tugas/{id}', [TugasController::class, 'show'])
    ->name('tugas.show');

Route::post('/tugas/{id}/submit', [TugasController::class, 'submit'])
    ->name('tugas.submit');

Route::get('/nilai', [NilaiController::class, 'index'])
    ->name('nilai');

Route::get('/kelas/{id}', [KelasController::class, 'show'])
    ->name('kelas.detail');
