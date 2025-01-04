<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\SessionController;
use App\Models\Appointment;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\HomeController;


use App\Http\Controllers\MembershipApplicationController;

use Illuminate\Database\Capsule\Manager;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;


use App\Http\Controllers\PlanController;
use App\Http\Controllers\PlanTypeController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\SportEquipmentController;
use App\Http\Controllers\TimeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

// Home route
Route::get('/home', [HomeController::class, 'index'])->name('home');

// Routes for admin middleware
Route::group(['middleware' => 'admin'], function () {
    Route::get('users/trash', [UserController::class, 'trashedUsers'])->name('users.trashed');
    Route::delete('users/{id}/forceDelete', [UserController::class, 'forceDelete'])->name('users.forceDelete');
    Route::post('users/{id}/restore', [UserController::class, 'restore'])->name('users.restore');
    Route::resource('users', UserController::class)->middleware('PreventDuplicateUser');

    Route::resource('plans', PlanController::class)->middleware('unique.plan');
    Route::resource('plan_types', PlanTypeController::class)->middleware('unique.plantype');
    Route::get('/search', [PlanController::class, 'search'])->name('plans.search');

    Route::get('dashboard', function () {
        return view('dashboard');
    });
});

// Appointments routes
Route::get('/appointments', [AppointmentController::class, 'index'])->name('appointments.index');
Route::get('/appointments/update_status/{id}/{type}', [AppointmentController::class, 'updateStatus'])->middleware('preventDoubleBooking');
Route::get('/appointments/search', [AppointmentController::class, 'search'])->name('appointment.search');

// Sessions routes
Route::put('sessions/update_status/{session}', [SessionController::class, 'updateStatus'])->name('sessions.updateStatus');
Route::resource('sessions', SessionController::class);

// Other resources
Route::resource('times', TimeController::class);
Route::resource('services', ServiceController::class);
Route::resource('ratings', RatingController::class);

// Membership applications routes
Route::get('/membership_applications', [MembershipApplicationController::class, 'index'])->name('membership_applications');
Route::post('/membership_applications/{id}/update_status', [MembershipApplicationController::class, 'updateStatus'])->name('membership_applications.update_status');
Route::delete('/membership_applications/{id}/destroy', [MembershipApplicationController::class, 'destroy'])->name('membership_applications.destroy');

// Attendance routes
Route::get('/attendance', [AttendanceController::class, 'index'])->name('attendance.index');
Route::post('/attendance/store', [AttendanceController::class, 'store'])->name('attendance.store');
Route::get('/attendance/{id}/{type}', [AttendanceController::class, 'update'])->name('attendance.update');
Route::delete('/attendance/{id}', [AttendanceController::class, 'destroy'])->name('attendance.destroy');

