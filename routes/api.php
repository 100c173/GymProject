<?php


use App\Http\Controllers\Api\AppointmentController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\API\MembershipApplicationController;
use App\Http\Controllers\Api\RatingController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\services;
use App\Http\Controllers\Api\LoginRegisterController;
use App\Http\Controllers\Api\PlanController;
use App\Http\Controllers\Api\SubscriptionController;

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

// Public routes of authtication
Route::controller(LoginRegisterController::class)->group(function() {
    Route::post('/register', 'register');
    Route::post('/login', 'login');
});
// Protected routes 
Route::middleware('auth:sanctum')->group( function () {
    Route::post('/logout', [LoginRegisterController::class, 'logout']);
    //الاشتراك في خطة
    Route::post('/subscriptions', [SubscriptionController::class, 'subscribe']);
    //لغاء الاشتراك
    Route::delete('/subscriptions/{id}', [SubscriptionController::class, 'cancelSubscription']);
    //عرض اشتراكات المستخدم
    Route::get('/users/{id}/subscriptions', [SubscriptionController::class, 'getUserSubscriptions']);
});
//plans
//عرض جميع الخطط
Route::get('/plans', [PlanController::class, 'index']);
//عرض تفاصيل خطة محددة
Route::get('/plans/{id}', [PlanController::class, 'show']);

Route::apiResource('membership-applications',MembershipApplicationController::class);
Route::apiResource('appointments',AppointmentController::class);

//services route 
Route::get('/service', [Services::class, 'index']);
Route::post('/services/store/{id}', [Services::class, 'store']);
Route::get('/services/show/{id}', [Services::class, 'show']);
Route::put('/services/update/{id}', [Services::class, 'update']);
Route::delete('/services/destroy/{id}', [Services::class, 'destroy']);


Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);


Route::apiResource('membership-applications', MembershipApplicationController::class);


Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('ratings', RatingController::class);
    Route::post('user/logout', [AuthController::class, 'logout']);
});
