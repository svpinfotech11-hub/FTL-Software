<?php

use App\Http\Controllers\BranchController;
use App\Http\Controllers\DomesticShipmentController;

use Khsingh\India\Entities\City;


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\LRMasterController;
use App\Http\Controllers\SuperAdminController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/', [HomeController::class, 'home'])->name('pages.home');
// Route::get('/dashboard', [UserController::class, 'dashboard'])->name('admin.dashboard');

Route::get('/dashboard', [UserController::class, 'dashboard'])->name('admin.dashboard');
Route::get('/', [HomeController::class, 'home'])->name('pages.home');
// Route::get('/dashboard', [UserController::class, 'dashboard'])->name('admin.dashboard');

Route::get('/user/create', [UserController::class, 'create'])->name('user.create');
Route::post('/user/create', [UserController::class, 'store'])->name('user.store');
Route::get('/user/index', [UserController::class, 'index'])->name('user.index');
Route::delete('/user/{user}', [UserController::class, 'destroy'])->name('user.destroy');


Route::post('/send-phone-otp', [AuthController::class, 'sendPhoneOtp']);
Route::post('/verify-phone-otp', [AuthController::class, 'verifyPhoneOtp']);
Route::get('/register', [AuthController::class, 'register'])->name('user.register');
Route::post('/register', [AuthController::class, 'registerStore'])->name('user.register.store');

Route::post('/send-email-otp', [AuthController::class, 'sendEmailOtp']);
Route::post('/verify-email-otp', [AuthController::class, 'verifyEmailOtp']);

Route::get('/auth/create', [UserController::class, 'create'])->name('admin.auth.create');
Route::post('/auth/create', [UserController::class, 'store'])->name('admin.auth.store');
Route::get('/auth/index', [UserController::class, 'index'])->name('admin.auth.index');


/* ================= USER ================= */
// Route::middleware('guest')->group(function () {
Route::get('/login', [AuthController::class, 'userLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'userLogin'])->name('user.login.store');
// });

// Route::middleware(['auth','role:user'])->group(function () {
Route::get('/dashboard', [UserController::class, 'dashboard'])
    ->name('user.dashboard');
// });

/* ================= SUPERADMIN ================= */
Route::middleware('guest')->group(function () {
    Route::get('/superadmin/login', [SuperAdminController::class, 'getmethod'])
        ->name('superadmin.login');

    Route::post('/superadmin/login', [SuperAdminController::class, 'adminLogin'])->name('superadmin.login');
});

Route::middleware(['superadmin'])->group(function () {
    Route::get('/superadmin/dashboard', [SuperAdminController::class, 'dashboardpp'])
        ->name('superadmin.dashboard');
});

// User logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


Route::get('/domestic-shipment/create', [DomesticShipmentController::class, 'create'])->name('domestic.shipment.create');
Route::post('/domestic-shipment/store', [DomesticShipmentController::class, 'store'])->name('domestic.shipment.store');
Route::get('/domestic-shipment/index', [DomesticShipmentController::class, 'index'])->name('domestic.shipment.index');
Route::get('/domestic-shipment/{id}/edit', [DomesticShipmentController::class, 'edit'])->name('domestic.shipment.edit');
Route::put('/domestic-shipment/{id}', [DomesticShipmentController::class, 'update'])->name('domestic.shipment.update');
Route::delete('/domestic-shipment/{id}', [DomesticShipmentController::class, 'destroy'])->name('domestic.shipment.destroy');
Route::get('/new_pod/{id}', [DomesticShipmentController::class, 'show'])->name('domestic.shipment.pod');



Route::get('/get-cities/{state}', [DomesticShipmentController::class, 'getCities']);

Route::get('/consignee-details/{id}', function ($id) {
    return response()->json(
        \App\Models\DomesticShipment::findOrFail($id)
    );
});

Route::get('consigner-details/{id}', function ($id) {
    return response()->json(
        \App\Models\DomesticShipment::findOrFail($id)
    );
});

// Superadmin logout
Route::post('/superadmin/logout', [SuperAdminController::class, 'logout'])->name('superadmin.logout');
Route::post('/user/verify-otp', [AuthController::class, 'verifyOtp'])->name('user.verifyOtp');


Route::get('/vendors/create', [VendorController::class, 'create'])->name('vendors.create');
Route::post('/vendors/create', [VendorController::class, 'store'])->name('vendors.store');
Route::get('/vendors/index', [VendorController::class, 'index'])->name('vendors.index');
Route::delete('/user/{user}', [VendorController::class, 'destroy'])->name('user.destroy');

Route::resource('branches', BranchController::class);
