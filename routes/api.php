<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\SigninController;
use App\Http\Controllers\API\SignupController;
use App\Http\Controllers\API\ContactController;
use App\Http\Controllers\API\SignoutController;
use App\Http\Controllers\API\PasswordResetController;
use App\Http\Controllers\API\PasswordUpdateController;
use App\Http\Controllers\API\ToggleFavoriteContactController;

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

/** Auth. **/
Route::prefix('/auth')->group(static function () {
    Route::post('/signin', SigninController::class);
    Route::post('/signup', SignupController::class);
    Route::post('/password/reset', PasswordResetController::class);
    Route::post('/password/update', PasswordUpdateController::class);

    Route::middleware('auth:sanctum')->post('/signout', SignoutController::class);
});

/** Contacts. **/
Route::middleware('auth:sanctum')->group(static function () {
    Route::apiResource('contacts', ContactController::class);
    Route::post('contacts/{id}/toggle_favorite', ToggleFavoriteContactController::class);
});


