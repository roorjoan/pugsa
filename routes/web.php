<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\DomainAccountRequestController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\LogController;
use App\Http\Controllers\ReportsController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AuthController::class, 'login'])->name('login');
Route::post('/', [AuthController::class, 'authLogin'])->name('auth.login');
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'store'])->name('auth.register');

//Route::middleware('auth')->group(function () {
Route::get('/dashboard', [AuthController::class, 'index'])->name('dashboard');
Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');

Route::resource('users', UserController::class);

Route::resource('services', ServiceController::class);

Route::resource('roles', RoleController::class);

Route::resource('permissions', PermissionController::class);

Route::get('/domain-requests/create', [DomainAccountRequestController::class, 'create'])->name('domain-requests.create');
Route::post('/domain-requests', [DomainAccountRequestController::class, 'store'])->name('domain-requests.store');
Route::get('/domain-requests', [DomainAccountRequestController::class, 'index'])->name('domain-requests.index');
Route::patch('/domain-requests/{domainRequest}/update', [DomainAccountRequestController::class, 'update'])->name('domain-requests.update');

Route::get('/services/{service}/execute', [ServiceController::class, 'execute'])->name('services.execute');

Route::get('/logs', [LogController::class, 'index'])->name('logs.index');

// Ruta para el chatbot de asistencia
//Route::get('/chatbot', [ChatbotController::class, 'index'])->name('chatbot.index');

// Rutas para los reportes
Route::get('/reports/audit', [ReportsController::class, 'index'])->name('reports.audit');
Route::get('/reports/trends', [ReportsController::class, 'getServiceTrends'])->name('reports.trends');
Route::get('/reports/domain-requests', [ReportsController::class, 'domainAccountRequests'])->name('reports.domain_requests');
Route::get('/reports/usability', [ReportsController::class, 'usabilityCharts'])->name('reports.usability');
//});
