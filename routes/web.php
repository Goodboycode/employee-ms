<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\EmployeeController;

Route::get('/', function () {
    return view('employees.index');
});


Route::resource('employees',EmployeeController::class);
Route::resource('stores',StoreController::class);