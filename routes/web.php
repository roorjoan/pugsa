<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AuthController::class, 'login'])->name('login');
Route::post('/', [AuthController::class, 'authLogin'])->name('auth.login');
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'store'])->name('auth.register');

//Route::middleware('auth')->group(function () {
Route::get('/dashboard', [AuthController::class, 'index'])->name('dashboard');
Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');

Route::resource('users', UserController::class)->only(['index', 'store', 'update', 'destroy']);
// asignar un rol a un usuario
Route::patch('users/{user}/role', [UserController::class, 'assignRole'])->name('users.assignRole');

Route::resource('services', ServiceController::class)->only(['index', 'store', 'update', 'destroy']);
// asignar servicios a un usuario
Route::patch('users/{user}/services', [UserController::class, 'assignServices'])->name('users.assignServices');

Route::resource('roles', RoleController::class)->only(['index', 'store', 'update', 'destroy', 'edit']);
Route::resource('permissions', PermissionController::class)->only(['index', 'store', 'update', 'destroy']);
//});
