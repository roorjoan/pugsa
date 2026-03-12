<?php

use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/register', [AuthController::class, 'create'])->name('auth.register');
Route::post('/register', [AuthController::class, 'store']);
Route::get('/', [AuthController::class, 'login'])->name('auth.login');
Route::post('/', [AuthController::class, 'authLogin']);
Route::get('/dashboard', [AuthController::class, 'index'])->name('dashboard');
