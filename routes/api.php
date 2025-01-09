<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\services;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\Api\LoginRegisterController;
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
//services route 
Route::apiResource('services',services::class);
});
//plans
//عرض جميع الخطط
Route::get('/plans', [PlanController::class, 'index']);
//عرض تفاصيل خطة محددة
Route::get('/plans/{id}', [PlanController::class, 'show']);

Route::apiResource('membership-applications',MembershipApplicationController::class);