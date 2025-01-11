<?php


use App\Http\Controllers\Api\AppointmentController;
use App\Http\Controllers\Api\AttendanceController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\API\MembershipApplicationController;
use App\Http\Controllers\Api\RatingController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\services;
use App\Http\Controllers\Api\PlanController;
use App\Http\Controllers\Api\SubscriptionController;
use App\Http\Controllers\Api\UserController;

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

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

//plans
Route::get('/plans', [PlanController::class, 'index']);
Route::get('/plans/{id}', [PlanController::class, 'show']);
Route::get('/plansWithSession/{id}', [PlanController::class, 'showPlanWithSession']);

Route::get('/services', [Services::class, 'index']);

Route::middleware('auth:sanctum')->group(function () {

    Route::apiResource('appointments', AppointmentController::class);

    Route::apiResource('users', UserController::class);
    Route::post('user/logout', [AuthController::class, 'logout']);

    Route::apiResource('/subscriptions', SubscriptionController::class);

    Route::apiResource('membership-applications', MembershipApplicationController::class);

    Route::apiResource('ratings', RatingController::class);
    Route::get('ratings/service/{id}', [RatingController::class, 'showServiceRatings']);
    Route::get('ratings/user/{id}', [RatingController::class, 'showTrainerRatings']);

    Route::get('/attendances/{id}', [AttendanceController::class, 'update']);

    Route::get('/services/show/{id}', [Services::class, 'show']);
});

Route::middleware(['auth:sanctum', 'role:admin'])->group(function () {
    Route::post('/services/store/{id}', [Services::class, 'store']);
    Route::put('/services/update/{id}', [Services::class, 'update']);
    Route::delete('/services/destroy/{id}', [Services::class, 'destroy']);
});
