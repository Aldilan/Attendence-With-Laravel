<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PresentController;
use App\Http\Controllers\NotPresentController;
use App\Http\Controllers\RombelController;
use App\Http\Controllers\RayonController;
use App\Http\Controllers\AttendenceController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardAdminController;
use App\Http\Controllers\DashboardStudentController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


// Login and logout
Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'auth']);
Route::post('/logout', [LoginController::class, 'logout']);

Route::get('/asAdmin', [DashboardAdminController::class, 'index'])->middleware('auth');
Route::get('/asStudent', [DashboardStudentController::class, 'index'])->middleware('auth');

Route::resource('rombels',RombelController::class)->middleware('auth');
Route::resource('rayons',RayonController::class)->middleware('auth');
Route::resource('attendences',AttendenceController::class)->middleware('auth');
Route::resource('students',StudentController::class)->middleware('auth');
Route::resource('admins',AdminController::class)->middleware('auth');
Route::resource('presents',PresentController::class)->middleware('auth');
Route::resource('notpresents',NotPresentController::class)->middleware('auth');