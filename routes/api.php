<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\OrderController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::get('/customers/goldmembers', [CustomerController::class, 'returnGoldMembers']);
Route::apiResource('customers', CustomerController::class);
// Route::apiResource('customers/{customer}/orders', OrderController::class);
Route::apiResource('customers.orders', OrderController::class);
