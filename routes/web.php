<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\EmployeeController;

Route::get('/', [EmployeeController::class, 'index']);
Route::get('/stores', [StoreController::class, 'index']);


Route::resource('employees',EmployeeController::class);
Route::resource('stores',StoreController::class);
