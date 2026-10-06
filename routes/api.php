<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShiftController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\AttendanceController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Departments
Route::get('/departments', [DepartmentController::class, 'index']);
Route::get('/departments/{id}', [DepartmentController::class, 'show']);
Route::put('/departments', [DepartmentController::class, 'update']);
Route::post('/departments', [DepartmentController::class, 'store']);
Route::delete('/departments/{department}', [DepartmentController::class, 'destroy']);

// Shifts
Route::get('/shifts', [ShiftController::class, 'index']);
Route::get('/shifts/{id}', [ShiftController::class, 'show']);
Route::put('/shifts', [ShiftController::class, 'update']);
Route::post('/shifts', [ShiftController::class, 'store']);
Route::delete('/shifts/{shift}', [ShiftController::class, 'destroy']);

// Employees
Route::get('/employees', [EmployeeController::class, 'index']);
Route::get('/employees/{id}', [EmployeeController::class, 'show']);
Route::put('/employees', [EmployeeController::class, 'update']);
Route::post('/employees', [EmployeeController::class, 'store']);
Route::delete('/employees/{employee}', [EmployeeController::class, 'destroy']);

// Activities
Route::get('/activities', [ActivityController::class, 'index']);
Route::get('/activities/{id}', [ActivityController::class, 'show']);
Route::put('/activities', [ActivityController::class, 'update']);
Route::post('/activities', [ActivityController::class, 'store']);
Route::delete('/activities/{activity}', [ActivityController::class, 'destroy']);