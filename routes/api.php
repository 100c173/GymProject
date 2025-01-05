<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\API\MembershipApplicationController;
use App\Http\Controllers\Api\RatingController;
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

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);


Route::apiResource('membership-applications', MembershipApplicationController::class);


Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('ratings', RatingController::class);
    Route::post('user/logout', [AuthController::class, 'logout']);
});
