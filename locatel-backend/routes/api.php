<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::resource('account', 'App\Http\Controllers\API\AccountController')->only([
    'store', 'show', 'update'
]);

Route::resource('transaction', 'App\Http\Controllers\API\TransactionController')->only([
    'store', 'show', 'update'
]);
