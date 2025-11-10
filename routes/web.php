<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\TugasController;
use App\Http\Controllers\NilaiController;
use App\Http\Controllers\NotificationController;

// Authentication Routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Optional: Registration Routes (uncomment if needed)
// Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
// Route::post('/register', [AuthController::class, 'register']);

// Protected Routes - Require Authentication
Route::middleware(['auth'])->group(function () {
    Route::get('/', [DashboardController::class, 'index']);

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    // Kelas routes - specific routes BEFORE wildcard routes
    Route::get('/kelas', [KelasController::class, 'index'])->name('kelas');
    Route::get('/kelas/create', [KelasController::class, 'create'])->name('kelas.create');
    Route::post('/kelas', [KelasController::class, 'store'])->name('kelas.store');
    Route::get('/kelas/{id}/edit', [KelasController::class, 'edit'])->name('kelas.edit');
    Route::put('/kelas/{id}', [KelasController::class, 'update'])->name('kelas.update');
    Route::delete('/kelas/{id}', [KelasController::class, 'destroy'])->name('kelas.destroy');
    Route::get('/kelas/{id}', [KelasController::class, 'show'])->name('kelas.detail');

    // Tugas routes - specific routes BEFORE wildcard routes
    Route::get('/tugas', [TugasController::class, 'index'])->name('tugas');
    Route::get('/tugas/create', [TugasController::class, 'create'])->name('tugas.create');
    Route::post('/tugas', [TugasController::class, 'store'])->name('tugas.store');
    Route::get('/tugas/{id}/edit', [TugasController::class, 'edit'])->name('tugas.edit');
    Route::put('/tugas/{id}', [TugasController::class, 'update'])->name('tugas.update');
    Route::delete('/tugas/{id}', [TugasController::class, 'destroy'])->name('tugas.destroy');
    Route::get('/tugas/{id}', [TugasController::class, 'show'])->name('tugas.show');
    
    // Grade submission
    Route::post('/submissions/{id}/grade', [TugasController::class, 'gradeSubmission'])->name('submissions.grade');

    Route::post('/tugas/{id}/submit', [TugasController::class, 'submit'])->name('tugas.submit');

    Route::get('/submissions/{id}/download', [TugasController::class, 'download'])->name('submissions.download');

    Route::get('/nilai', [NilaiController::class, 'index'])->name('nilai');

    // Notifications
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');

    Route::get('/api/notifications/unread', [NotificationController::class, 'getUnread'])->name('notifications.unread');

    Route::post('/notifications/{id}/read', [NotificationController::class, 'markAsRead'])->name('notifications.read');

    Route::post('/notifications/read-all', [NotificationController::class, 'markAllAsRead'])->name('notifications.readAll');
});
