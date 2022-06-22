<?php

use App\Http\Controllers\API\auth\LoginController;
use App\Http\Controllers\API\auth\RegisterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


// Public Routes
Route::prefix('v1')->group(function () {

    // Regitser user API
    Route::post('register', [RegisterController::class, 'register']);


    // API for user active email
    Route::get('activation/{token}', [RegisterController::class, 'signupActive']);

    // API for user login
    Route::post('login', [LoginController::class, 'login']);

    // Private Routes
    Route::middleware("auth:api")->group(function () {

        // Show user profile
        Route::get('profile', [LoginController::class, 'profile']);
    });
});
