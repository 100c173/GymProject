<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\services;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\API\MembershipApplicationController;

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
Route::post('user/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

Route::apiResource('membership-applications',MembershipApplicationController::class);

//services route 
Route::get('/service', [Services::class, 'index']);
Route::post('/services/store/{id}', [Services::class, 'store']);
Route::get('/services/show/{id}', [Services::class, 'show']);
Route::put('/services/update/{id}', [Services::class, 'update']);
Route::delete('/services/destroy/{id}', [Services::class, 'destroy']);