<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\EmployeeController;

Route::get('/', function () {
    return view('welcome');
});

// Store
Route::get('/stores', [StoreController::class, 'index'])->name('stores.index');

// Employee
Route::get('/employees', [EmployeeController::class, 'index'])->name('employees.index');