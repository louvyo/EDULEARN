<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\TugasController;
use App\Http\Controllers\NilaiController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\AktivitasController;
use App\Http\Controllers\ProfileController;
use Laravel\Socialite\Facades\Socialite;

// Authentication Routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// OAuth: Google
Route::get('/auth/google', [AuthController::class, 'googleRedirect'])->name('oauth.google.redirect');
Route::get('/auth/google/callback', [AuthController::class, 'googleCallback'])->name('oauth.google.callback');

// Optional: Registration Routes (uncomment if needed)
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

// Protected Routes - Require Authentication
Route::middleware(['auth'])->group(function () {
    Route::get('/', [DashboardController::class, 'index']);

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    // Kelas routes - specific routes BEFORE wildcard routes
    Route::get('/kelas', [KelasController::class, 'index'])->name('kelas');
    Route::get('/kelas/create', [KelasController::class, 'create'])->name('kelas.create');
    Route::get('/kelas/join', [EnrollmentController::class, 'showJoinForm'])->name('kelas.join');
    Route::post('/kelas/join', [EnrollmentController::class, 'joinKelas'])->name('kelas.join.submit');
    Route::post('/kelas', [KelasController::class, 'store'])->name('kelas.store');
    Route::get('/kelas/{id}/edit', [KelasController::class, 'edit'])->name('kelas.edit');
    Route::get('/kelas/{id}/students', [EnrollmentController::class, 'students'])->name('kelas.students');
    Route::put('/kelas/{id}', [KelasController::class, 'update'])->name('kelas.update');
    Route::delete('/kelas/{id}', [KelasController::class, 'destroy'])->name('kelas.destroy');
    Route::post('/kelas/{id}/leave', [EnrollmentController::class, 'leaveClass'])->name('kelas.leave');
    Route::post('/kelas/{kelasId}/approve/{userId}', [EnrollmentController::class, 'approve'])->name('kelas.approve');
    Route::post('/kelas/{kelasId}/reject/{userId}', [EnrollmentController::class, 'reject'])->name('kelas.reject');
    Route::delete('/kelas/{kelasId}/remove/{userId}', [EnrollmentController::class, 'removeStudent'])->name('kelas.remove');
    Route::get('/kelas/{id}', [KelasController::class, 'show'])->name('kelas.detail');

    // Tugas routes - specific routes BEFORE wildcard routes
    Route::get('/tugas', [TugasController::class, 'index'])->name('tugas');
    Route::get('/tugas/create', [TugasController::class, 'create'])->name('tugas.create');
    Route::post('/tugas', [TugasController::class, 'store'])->name('tugas.store');
    Route::get('/tugas/{id}/edit', [TugasController::class, 'edit'])->name('tugas.edit');
    Route::put('/tugas/{id}', [TugasController::class, 'update'])->name('tugas.update');
    Route::delete('/tugas/{id}', [TugasController::class, 'destroy'])->name('tugas.destroy');
    Route::get('/tugas/{id}', [TugasController::class, 'show'])->name('tugas.show');
    
    // Aktivitas/Materi routes
    Route::get('/kelas/{kelasId}/aktivitas/create', [AktivitasController::class, 'create'])->name('aktivitas.create');
    Route::post('/kelas/{kelasId}/aktivitas', [AktivitasController::class, 'store'])->name('aktivitas.store');
    Route::get('/aktivitas/{id}/edit', [AktivitasController::class, 'edit'])->name('aktivitas.edit');
    Route::put('/aktivitas/{id}', [AktivitasController::class, 'update'])->name('aktivitas.update');
    Route::get('/aktivitas/{id}/download', [AktivitasController::class, 'download'])
        ->middleware('signed')
        ->name('aktivitas.download');
    Route::delete('/aktivitas/{id}', [AktivitasController::class, 'destroy'])->name('aktivitas.destroy');
    
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

    // Profile
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password');
    Route::post('/profile/avatar', [ProfileController::class, 'updateAvatar'])->name('profile.avatar');
});
