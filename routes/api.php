<?php

use App\Http\Controllers\Api\AttendanceController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ClassesController;
use App\Http\Controllers\Api\ScheduleController;
use App\Http\Controllers\Api\StudentController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

//Route::post('admin/login', [AuthController::class, 'login'])->name('login');
//Route::post('register', [AuthController::class, 'register'])->name('register');

Route::prefix('classes')->group(function() {
    Route::get('/', [ClassesController::class, 'index'])->name('classes.index');
    Route::get('/all', [ClassesController::class, 'getAll'])->name('classes.all');
    Route::post('/create', [ClassesController::class, 'store'])->name('classes.store');
    Route::put('/edit/{id}', [ClassesController::class, 'edit'])->name('classes.edit');
    Route::get('/detail/{id}', [ClassesController::class, 'show'])->name('classes.detail');
    Route::delete('delete/{id}', [ClassesController::class, 'delete'])->name('classes.delete');
});
Route::prefix('students')->group(function() {
    Route::get('/', [StudentController::class, 'index'])->name('student.index');
    Route::post('/create', [StudentController::class, 'store'])->name('student.store');
    Route::put('/update/{id}', [StudentController::class, 'update'])->name('student.update');
    Route::get('/detail/{id}', [StudentController::class, 'show'])->name('student.detail');
    Route::delete('delete/{id}', [StudentController::class, 'delete'])->name('student.delete');
});

Route::get('report', [AttendanceController::class, 'report'])->name('report');
