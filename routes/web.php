<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\SessionController;
use App\Models\Appointment;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\PlanTypeController;
use App\Http\Controllers\UserController;

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
Route::get('users/trash', [UserController::class, 'trashedUsers'])->name('users.trashed');
Route::delete('users/{id}/forceDelete', [UserController::class, 'forceDelete'])->name('users.forceDelete');
Route::post('users/{id}/restore', [UserController::class, 'restore'])->name('users.restore');
Route::resource('users', UserController::class);

Route::get('/', function () {
    return view('auth.login');
});


Route::get('/appointments',[AppointmentController::class,'index']);
Route::get('/appointments/update_status/{id}/{type}',[AppointmentController::class,'updateStatus']);
Route::get('/appointments/search',[AppointmentController::class,'search'])->name('appointment.search');

Route::resource('sessions',SessionController::class);

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::resource('plans',PlanController::class);
Route::resource('plan_types',PlanTypeController::class);
Route::get('/search',[PlanController::class,'search'])->name("plans.search");

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('dashboard', function () {
    return view('dashboard');
});


Route::get('/attendance', [AttendanceController::class, 'index'])->name('attendance.index');
Route::post('/attendance/store', [AttendanceController::class, 'store'])->name('attendance.store');
Route::get('/attendance/{id}/{type}', [AttendanceController::class, 'update'])->name('attendance.update');
Route::delete('/attendance/{id}', [AttendanceController::class, 'destroy'])->name('attendance.destroy');
