<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrderController;

//Customers
Route::post('customers', [CustomerController::class, 'store'])->middleware('auth:sanctum');
Route::get('customers', [CustomerController::class, 'index']);
Route::get('customers/{customer}', [CustomerController::class, 'show']);
Route::delete('customers/{customer}', [CustomerController::class, 'destroy'])->middleware('auth:sanctum');
//Gold members
Route::get('/customers/goldmembers', [CustomerController::class, 'returnGoldMembers']);

//AUTH
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

//Orders
Route::post('customers/{customer}/orders', [OrderController::class, 'store'])->middleware('auth:sanctum');
Route::get('customers/{customer}/orders', [OrderController::class, 'index']);
Route::get('customers/{customer}/orders/{order}', [OrderController::class, 'show']);