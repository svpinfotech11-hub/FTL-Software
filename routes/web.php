<?php

use App\Http\Controllers\DomesticShipmentController;
use App\Http\Controllers\LRMasterController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Khsingh\India\Entities\City;


Route::get('/', function () {
    return view('welcome');
});


Route::get('/dashboard', [UserController::class, 'dashboard'])->name('admin.dashboard');



Route::get('/lrmaster/create', [LRMasterController::class, 'create'])->name('admin.lrmaster.create');
Route::post('/lrmaster/create', [LRMasterController::class, 'store'])->name('admin.lrmaster.store');
Route::get('/lrmaster/index', [LRMasterController::class, 'index'])->name('admin.lrmaster.index');

Route::get('/domestic-shipment/create', [DomesticShipmentController::class, 'create'])->name('domestic.shipment.create');
Route::post('/domestic-shipment/store', [DomesticShipmentController::class, 'store'])->name('domestic.shipment.store');
Route::get('/domestic-shipment/index', [DomesticShipmentController::class, 'index'])->name('domestic.shipment.index');
Route::get('/domestic-shipment/{id}/edit', [DomesticShipmentController::class, 'edit'])->name('domestic.shipment.edit');
Route::put('/domestic-shipment/{id}', [DomesticShipmentController::class, 'update'])->name('domestic.shipment.update');
Route::delete('/domestic-shipment/{id}', [DomesticShipmentController::class, 'destroy'])->name('domestic.shipment.destroy');

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
