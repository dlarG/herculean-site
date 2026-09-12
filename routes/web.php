<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\CoachAuthController;
use App\Http\Controllers\Coach\CoachDashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RegistrationController;
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

Route::middleware('auth:coach')->prefix('coach')->name('coach.')->group(function () {
    Route::get('/change-password', [CoachAuthController::class, 'showChangePasswordForm'])->name('password.change');
    Route::post('/change-password', [CoachAuthController::class, 'changePassword'])->name('password.update');

    Route::get('/dashboard', [CoachDashboardController::class, 'index'])->name('dashboard');
    Route::get('/events', [CoachDashboardController::class, 'myEvents'])->name('events');
    Route::get('/students', [CoachDashboardController::class, 'myStudents'])->name('students');

    Route::get('/announcements', [CoachDashboardController::class, 'announcements'])->name('announcements');
    Route::get('/announcements/create', [CoachDashboardController::class, 'createAnnouncement'])->name('announcements.create');
    Route::post('/announcements', [CoachDashboardController::class, 'storeAnnouncement'])->name('announcements.store');
    Route::delete('/announcements/{announcement}', [CoachDashboardController::class, 'destroyAnnouncement'])->name('announcements.destroy');
});