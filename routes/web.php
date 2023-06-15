<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Route::get('/dashboard', 'App\Http\Controllers\DashboardController@index')->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::group(['middleware' => ['auth', 'role:admin']], function(){
    Route::get('/admin/dashboard', 'App\Http\Controllers\admin\DashboardController@index')->name('admin-dashboard');

    Route::get('/admin/employees', 'App\Http\Controllers\admin\EmployeeController@index')->name('admin-employees');
    Route::post('/admin/add-employee', 'App\Http\Controllers\admin\EmployeeController@add')->name('admin-add-employee');
    Route::post('/admin/update-employee', 'App\Http\Controllers\admin\EmployeeController@update')->name('admin-update-employee');
    Route::post('/admin/delete-employee', 'App\Http\Controllers\admin\EmployeeController@delete')->name('admin-delete-employee');

    Route::get('/admin/attendances', 'App\Http\Controllers\admin\AttendanceController@index')->name('admin-attendances');
    Route::post('/admin/check-in', 'App\Http\Controllers\admin\AttendanceController@checkin')->name('admin-check-in');
    Route::post('/admin/check-out', 'App\Http\Controllers\admin\AttendanceController@checkout')->name('admin-check-out');
    Route::post('/admin/attendance-report', 'App\Http\Controllers\admin\AttendanceController@report')->name('admin-attendance-report');
});

Route::group(['middleware' => ['auth', 'role:user']], function(){
    Route::get('/user/dashboard', 'App\Http\Controllers\user\DashboardController@index')->name('user-dashboard');
});



require __DIR__.'/auth.php';
