<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\FuelLogController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\UserSessionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ServiceItemController;
use App\Http\Controllers\ServiceScheduleController;
use App\Http\Controllers\VehicleController;
use App\Models\Qualification;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::prefix('/auth')->group(function () {
    Route::post("/login-backend", [AuthController::class, 'login_backend']);
    Route::post("/register-backend", [AuthController::class, 'registerBackend']);
});


Route::prefix('/users')->group(function () {
    Route::get("/", [UserSessionController::class, 'all']);
    Route::post("/store", [UserSessionController::class, 'store']);
    Route::get("/{id}/show", [UserSessionController::class, 'show']);
    Route::post("/update", [UserSessionController::class, 'update']);
    Route::get("/{id}/detail", [UserSessionController::class, 'detail']);
    Route::post("/{id}/delete", [UserSessionController::class, 'delete']);
    Route::post("/save-document", [UserSessionController::class, 'saveStudentDocument']);
    Route::post("/card-generate", [UserSessionController::class, 'generateUserCard']);
    Route::get("/{id}/get-user", [UserSessionController::class, 'getUser']);
});

Route::prefix('/roles')->group(function () {
    Route::get("/get", [RoleController::class, 'getRole']);
});



Route::prefix('/email-notification')->group(function () {
    Route::post('/send', 'App\Http\Controllers\EmailNotificationController@send');
});

Route::prefix('/vehicle')->group(function () {
    Route::get("/", [VehicleController::class, 'all']);
    Route::post("/store", [VehicleController::class, 'store']);
    Route::get("/{id}/show", [VehicleController::class, 'show']);
    Route::post("/update", [VehicleController::class, 'update']);
    Route::post("/{id}/delete", [VehicleController::class, 'delete']);
});


Route::prefix('/material')->group(function () {
    Route::get("/", [MaterialController::class, 'all']);
    Route::post("/store", [MaterialController::class, 'store']);
    Route::get("/{id}/show", [MaterialController::class, 'show']);
    Route::post("/update", [MaterialController::class, 'update']);
    Route::post("/{id}/delete", [MaterialController::class, 'delete']);
});

Route::prefix('/service-item')->group(function () {
    Route::get("/", [ServiceItemController::class, 'all']);
    Route::post("/store", [ServiceItemController::class, 'store']);
    Route::get("/{id}/show", [ServiceItemController::class, 'show']);
    Route::post("/update", [ServiceItemController::class, 'update']);
    Route::post("/{id}/delete", [ServiceItemController::class, 'delete']);
});

Route::prefix('/service-schedule')->group(function () {
    Route::get("/", [ServiceScheduleController::class, 'all']);
    Route::post("/store", [ServiceScheduleController::class, 'store']);
    Route::get("/{id}/show", [ServiceScheduleController::class, 'show']);
    Route::post("/update", [ServiceScheduleController::class, 'update']);
    Route::post("/{id}/delete", [ServiceScheduleController::class, 'delete']);
});

Route::prefix('/fuel-log')->group(function () {
    Route::get("/", [FuelLogController::class, 'all']);
    Route::post("/store", [FuelLogController::class, 'store']);
    Route::get("/{id}/show", [FuelLogController::class, 'show']);
    Route::post("/get-fuel-log", [FuelLogController::class, 'getFuelLog']);
    Route::post("/update", [FuelLogController::class, 'update']);
    Route::post("/{id}/delete", [FuelLogController::class, 'delete']);
    
});

Route::prefix('/driver')->group(function () {
    Route::get("/", [DriverController::class, 'all']);
    Route::post("/store", [DriverController::class, 'store']);
    Route::get("/{id}/show", [DriverController::class, 'show']);
    Route::post("/update", [DriverController::class, 'update']);
    Route::post("/{id}/delete", [DriverController::class, 'delete']);
    
});

Route::prefix('/setting')->group(function () {
    Route::post('/update', 'App\Http\Controllers\SettingController@update');
});

//});
