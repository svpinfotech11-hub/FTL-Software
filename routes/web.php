<?php

use App\Http\Controllers\LRMasterController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/dashboard', [UserController::class, 'dashboard'])->name('admin.dashboard');



Route::get('/lrmaster/create', [LRMasterController::class, 'create'])->name('admin.lrmaster.create');
Route::post('/lrmaster/create', [LRMasterController::class, 'store'])->name('admin.lrmaster.store');
Route::get('/lrmaster/index', [LRMasterController::class, 'index'])->name('admin.lrmaster.index');

