<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['namespace' => API_NAMESPACE_PREFIX], function () {

    Route::post('auth/login', 'AuthController@login');

    // Config
    Route::get('config/module-type', 'ConfigController@moduleType');
    Route::get('config/advertisements', 'ConfigController@advertisements');

    // Middleware
    Route::group(['middleware' => 'auth.api'], function () {
        Route::get('/dashboard/update-login-info', [AuthController::class, 'update_date']);

        // Logout
        Route::get('auth/logout', 'AuthController@logout');
        Route::get('/expired', 'UserController@expiredDate');

        // Profile
        Route::post('profile/details', 'ProfileController@details');
        Route::post('profile/plan-purchase', 'ProfileController@planPurchase');
        Route::post('profile/backup', 'ProfileController@backup');


        // Click
        Route::post('click/{key}', 'ClickCountController@addClick');


    });


});
