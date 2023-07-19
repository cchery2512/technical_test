<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Participant\ParticipantController;
use App\Http\Controllers\Participant\ParticipantResultsController;
use App\Http\Controllers\Staff\StaffController;
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


Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);

Route::group(['middleware' => 'auth:sanctum'], function () {

    Route::group(['prefix' => 'account'], function () {
        Route::get('/', [AccountController::class, 'show'])->middleware('permission:account.show');
        Route::post('/update', [AccountController::class, 'update'])->middleware('permission:account.update');;
    });

    Route::apiResource('staff', StaffController::class);

    Route::apiResource('participant', ParticipantController::class);

    Route::apiResource('result', ParticipantResultsController::class);
});
