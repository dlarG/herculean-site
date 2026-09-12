<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\CoachAuthController;
use App\Http\Controllers\Auth\StudentAuthController;
use App\Http\Controllers\CoachAnnouncementController;
use App\Http\Controllers\CoachDashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\StudentDashboardController;
use Illuminate\Support\Facades\Route;


Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/register', [RegistrationController::class, 'create'])->name('register.create');
Route::post('/register', [RegistrationController::class, 'store'])->name('register.store');

// Guest-only auth routes
Route::get('/admin/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/admin/login', [AuthController::class, 'login'])->name('login.attempt');
Route::post('/admin/logout', [AuthController::class, 'logout'])->name('logout');

// Protected admin routes
Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('dashboard');
    Route::delete('/entries/{entry}', [AdminController::class, 'destroy'])->name('entries.destroy');
    Route::post('/entries/export-pdf', [AdminController::class, 'exportPdf'])->name('entries.export-pdf');
});

Route::prefix('coach')->name('coach.')->group(function () {
    Route::middleware('guest:coach')->group(function () {
        Route::get('/login', [CoachAuthController::class, 'showLoginForm'])->name('login');
        Route::post('/login', [CoachAuthController::class, 'login'])->name('login.attempt');
    });

    Route::middleware('auth:coach')->group(function () {
        Route::post('/logout', [CoachAuthController::class, 'logout'])->name('logout');

        Route::get('/password/change', [CoachAuthController::class, 'showChangePasswordForm'])->name('password.change');
        Route::post('/password/change', [CoachAuthController::class, 'changePassword'])->name('password.update');

        Route::get('/dashboard', [CoachDashboardController::class, 'index'])->name('dashboard');
        Route::get('/export', [CoachDashboardController::class, 'exportPdf'])->name('export');

        Route::get('/announcements', [CoachAnnouncementController::class, 'index'])->name('announcements.index');
        Route::get('/announcements/create', [CoachAnnouncementController::class, 'create'])->name('announcements.create');
        Route::post('/announcements', [CoachAnnouncementController::class, 'store'])->name('announcements.store');
        Route::get('/announcements/{announcement}/edit', [CoachAnnouncementController::class, 'edit'])->name('announcements.edit');
        Route::put('/announcements/{announcement}', [CoachAnnouncementController::class, 'update'])->name('announcements.update');
        Route::delete('/announcements/{announcement}', [CoachAnnouncementController::class, 'destroy'])->name('announcements.destroy');
    });
});

Route::prefix('student')->name('student.')->group(function () {
    Route::middleware('guest:student')->group(function () {
        Route::get('/login', [StudentAuthController::class, 'showLoginForm'])->name('login');
        Route::post('/login', [StudentAuthController::class, 'login'])->name('login.attempt');
    });

    Route::middleware('auth:student')->group(function () {
        Route::get('/dashboard', [StudentDashboardController::class, 'index'])->name('dashboard');
        Route::post('/logout', [StudentAuthController::class, 'logout'])->name('logout');
    });
});