<?php

use App\Http\Controllers\API\auth\RegisterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::prefix('v1')->group(function () {

    // Regitser user API
    Route::post('register', [RegisterController::class,'register']);


    Route::get('activation/{token}', [RegisterController::class, 'signupActive']);

});
