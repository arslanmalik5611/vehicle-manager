<?php

use Illuminate\Support\Facades\Route;

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
Route::get('abc', function () {
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('view:clear');

    App\Models\User::create([
        'first_name' => 'dsdd',
        'email' => 'admin@web.com',
        'password' => \Illuminate\Support\Facades\Hash::make(123456)
    ]);
    echo $User = \App\Models\User::find(1);
    //echo $User->createToken('WEBSITE')->plainTextToken;
});

Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('cache:clear');
    // return what you want
});
/*Route::get('/', 'App\Http\Controllers\AuthController@login');
Route::get('/home', 'App\Http\Controllers\CampusTypeController@index');
Route::get('/{reset_password_token}/reset', 'App\Http\Controllers\AuthController@reset');*/
// Route::get('/', 'App\Http\Controllers\AuthController@login');

Route::get('/dashboard', 'App\Http\Controllers\DashboardController@index');
Route::get('/', 'App\Http\Controllers\HomeController@index');
Route::get('/home', 'App\Http\Controllers\HomeController@index');
Route::get('/image', 'App\Http\Controllers\HomeController@makeimage');
Route::get('/login', 'App\Http\Controllers\AuthController@login');
Route::get('/register', 'App\Http\Controllers\AuthController@register');
Route::get('/forgot', 'App\Http\Controllers\AuthController@forgot');
Route::get('/{reset_password_token}/reset', 'App\Http\Controllers\AuthController@reset');

// Route::get('user/login', 'App\Http\Controllers\UserController@login');



Route::prefix('/users')->group(function () {
    Route::get('/', 'App\Http\Controllers\UserSessionController@index');
    Route::get('/create', 'App\Http\Controllers\UserSessionController@create');
    Route::get('/{id}/edit', 'App\Http\Controllers\UserSessionController@edit');
    Route::get('/{id}/detail', 'App\Http\Controllers\UserSessionController@detailView');
});

Route::prefix('/department')->group(function () {
    Route::get('/', 'App\Http\Controllers\DepartmentController@index');
    Route::get('/create', 'App\Http\Controllers\DepartmentController@create');
    Route::get('/{id}/edit', 'App\Http\Controllers\DepartmentController@edit');
});

Route::prefix('/vehicle')->group(function () {
    Route::get('/', 'App\Http\Controllers\VehicleController@index');
    Route::get('/create', 'App\Http\Controllers\VehicleController@create');
    Route::get('/{id}/edit', 'App\Http\Controllers\VehicleController@edit');
});

Route::prefix('/material')->group(function () {
    Route::get('/', 'App\Http\Controllers\MaterialController@index');
    Route::get('/create', 'App\Http\Controllers\MaterialController@create');
    Route::get('/{id}/edit', 'App\Http\Controllers\MaterialController@edit');
});

Route::prefix('/service-item')->group(function () {
    Route::get('/', 'App\Http\Controllers\ServiceItemController@index');
    Route::get('/create', 'App\Http\Controllers\ServiceItemController@create');
    Route::get('/{id}/edit', 'App\Http\Controllers\ServiceItemController@edit');
});

Route::prefix('/service-schedule')->group(function () {
    Route::get('/', 'App\Http\Controllers\ServiceScheduleController@index');
    Route::get('/create', 'App\Http\Controllers\ServiceScheduleController@create');
    Route::get('/{id}/edit', 'App\Http\Controllers\ServiceScheduleController@edit');
});

Route::prefix('/fuel-log')->group(function () {
    Route::get('/', 'App\Http\Controllers\FuelLogController@index');
    Route::get('/create', 'App\Http\Controllers\FuelLogController@create');
    Route::get('/{id}/edit', 'App\Http\Controllers\FuelLogController@edit');
});



