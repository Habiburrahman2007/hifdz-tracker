<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SetoranController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SettingController;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

Route::resource('teachers', TeacherController::class)->except(['show']);
Route::resource('students', StudentController::class)->except(['show']);
Route::resource('setoran', SetoranController::class)->except(['show']);
Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
Route::post('/settings', [SettingController::class, 'update'])->name('settings.update');
