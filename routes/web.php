<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\Login;
use App\Http\Controllers\Auth\Logout;
use App\Http\Controllers\ShiftController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\CheckListController;

// Group of routes
Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/', function() { return view('home'); })->name('home');

    Route::get('/employees', [EmployeeController::class, 'index'])->name('employees');
    Route::get('/attendance', [AttendanceController::class, 'index'])->name('attendance');
    
    Route::get('/shifts', [ShiftController::class, 'index'])->name('shifts');
    Route::get('/departments', [DepartmentController::class, 'index'])->name('departments');
    Route::get('/activities', [ActivityController::class, 'index'])->name('activities');

    Route::get('/checkList', [CheckListController::class, 'index'])->name('checkList');

});

// Login routes
Route::view('/login', 'auth.login')
    ->middleware('guest')
    ->name('login');

Route::post('/login', Login::class)
    ->middleware('guest');

// Logout route
Route::post('/logout', Logout::class)
    ->middleware('auth')
    ->name('logout');