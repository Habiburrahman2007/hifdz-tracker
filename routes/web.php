<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SetoranController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('landing');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');

    // Read-only routes (accessible by all authenticated users including guardian)
    Route::get('teachers', [TeacherController::class, 'index'])->name('teachers.index');
    Route::get('students', [StudentController::class, 'index'])->name('students.index');
    Route::get('setoran', [SetoranController::class, 'index'])->name('setoran.index');

    // Ustadz only routes (for setoran CRUD)
    Route::middleware('role:ustadz')->group(function () {
        Route::resource('setoran', SetoranController::class)->except(['index', 'show']);
    });

    // Admin only routes
    Route::middleware('role:admin')->group(function () {
        Route::resource('students', StudentController::class)->except(['index', 'show']);
        Route::resource('teachers', TeacherController::class)->except(['index', 'show']);
        Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
        Route::post('/settings', [SettingController::class, 'update'])->name('settings.update');
    });
});
