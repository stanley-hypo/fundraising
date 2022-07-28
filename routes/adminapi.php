<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\SettingController;
use Illuminate\Support\Facades\Route;

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::middleware('auth:adminapi')->group(function () {
    Route::post('getme', [AuthController::class, 'me']);

    Route::post('checkUnique', [AuthController::class, 'checkUnique']);
    Route::post('register', [AuthController::class, 'register']);
    Route::post('/user/update', [AuthController::class, 'update']);
    Route::post('/user/show', [AuthController::class, 'show']);
    Route::post('/user/updatepwd', [AuthController::class, 'updatepwd']);

    //Role
    Route::post('list_user', [AuthController::class, 'list']);
    Route::post('roleList', [AuthController::class, 'roleList']);
    Route::post('/role/show', [AuthController::class, 'role_show']);
    Route::post('/role/update', [AuthController::class, 'role_update']);

    //Lewis:
    //Donation
    

    //Setting
    Route::post('/settings/index', [SettingController::class, 'index']);
    Route::post('/settings/update', [SettingController::class, 'update']);
});
