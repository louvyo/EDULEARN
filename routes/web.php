<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\TugasController;
use App\Http\Controllers\NilaiController;
use App\Http\Controllers\NotificationController;

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

Route::get('/submissions/{id}/download', [TugasController::class, 'download'])
    ->name('submissions.download');

Route::get('/nilai', [NilaiController::class, 'index'])
    ->name('nilai');

Route::get('/kelas/{id}', [KelasController::class, 'show'])
    ->name('kelas.detail');

// Notifications
Route::get('/notifications', [NotificationController::class, 'index'])
    ->name('notifications.index');

Route::get('/api/notifications/unread', [NotificationController::class, 'getUnread'])
    ->name('notifications.unread');

Route::post('/notifications/{id}/read', [NotificationController::class, 'markAsRead'])
    ->name('notifications.read');

Route::post('/notifications/read-all', [NotificationController::class, 'markAllAsRead'])
    ->name('notifications.readAll');
