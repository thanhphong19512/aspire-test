<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::post('/login', 'App\Http\Controllers\AuthController@login');

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('/loan', 'App\Http\Controllers\LoanController');

    Route::put('/loan/approve/{loan}', 'App\Http\Controllers\LoanController@approveLoan');

//    Route::put('/repayment/{repayment}', 'App\Http\Controllers\ScheduledRepaymentController@repaymentLoan');
});

