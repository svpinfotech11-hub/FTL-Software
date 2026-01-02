<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LRMasterController;
use App\Http\Controllers\SuperAdminController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', [HomeController::class, 'home'])->name('pages.home');
// Route::get('/dashboard', [UserController::class, 'dashboard'])->name('admin.dashboard');

Route::get('/lrmaster/create', [LRMasterController::class, 'create'])->name('admin.lrmaster.create');
Route::post('/lrmaster/create', [LRMasterController::class, 'store'])->name('admin.lrmaster.store');
Route::get('/lrmaster/index', [LRMasterController::class, 'index'])->name('admin.lrmaster.index');

Route::post('/send-phone-otp', [AuthController::class, 'sendPhoneOtp']);
Route::post('/verify-phone-otp', [AuthController::class, 'verifyPhoneOtp']);
Route::post('/register', [AuthController::class, 'register']);

Route::post('/send-email-otp', [AuthController::class, 'sendEmailOtp']);
Route::post('/verify-email-otp', [AuthController::class, 'verifyEmailOtp']);

Route::get('/auth/create', [UserController::class, 'create'])->name('admin.auth.create');
Route::post('/auth/create', [UserController::class, 'store'])->name('admin.auth.store');
Route::get('/auth/index', [UserController::class, 'index'])->name('admin.auth.index');


/* ================= USER ================= */
Route::get('/login', [AuthController::class, 'userLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'userLogin']);

Route::middleware(['auth','role:user'])->group(function () {
    Route::get('/dashboard', [UserController::class, 'dashboard'])
        ->name('admin.dashboard');
});

/* ================= SUPERADMIN ================= */
Route::get('/superadmin/login', [SuperAdminController::class, 'getmethod'])
    ->name('superadmin.login');

Route::post('/superadmin/login', [SuperAdminController::class, 'adminLogin'])->name('superadmin.login');

Route::middleware(['superadmin'])->group(function () {
    Route::get('/superadmin/dashboard', [SuperAdminController::class, 'dashboardpp'])
        ->name('superadmin.dashboard');
});

// User logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Superadmin logout
Route::post('/superadmin/logout', [SuperAdminController::class, 'logout'])->name('superadmin.logout');
