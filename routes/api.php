<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RestPasswordController;

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
Route::controller(AuthController::class)->group(function () {

    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::post('logout', 'logout');
    Route::post('refresh', 'refresh');
});

Route::controller(UserController::class)->group(function () {
    Route::get('users', 'index');
    Route::post('users', 'store');
    Route::post('users/update', 'update');
    Route::delete('users/delete', 'destroy');
    Route::post('users/change-password', 'updatePassword');
});

Route::group(['controller' => RestPasswordController::class], function (){
    // Request password reset link
    Route::post('forgot-password', 'resetLink')->name('password.reset');
    // Reset password
    Route::post('reset-password', 'resetPassword');

    Route::get('reset-password/{token}', function (string $token) {
         return $token;
     });
});

