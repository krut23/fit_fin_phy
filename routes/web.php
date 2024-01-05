<?php

use Illuminate\Support\Facades\Route;

//Route::get('/', function () { return redirect()->route('home');});

// User /////////////////////////////////////////////////////////////////////////////////////////////////////////////
//Route::group(['namespace' => USER_NAMESPACE_PREFIX, 'as' => USER_NAMED_ROUTE_PREFIX], function () {Route::get('/', 'HomeController@index')->name('home');});


Route::get('/', function () {
    return redirect()->route('dashboard');
});

// Admin /////////////////////////////////////////////////////////////////////////////////////////////////////////////
Route::get('admin', function () {
    return redirect()->route('dashboard');
});


Route::group(['namespace' => ADMIN_NAMESPACE_PREFIX, 'prefix' => ADMIN_NAME], function () {


    Route::get('not-access', 'AuthenticationController@notAccess')->name('not.access');

    // Authentication
    Route::get('login', 'AuthenticationController@index')->name('login');
    Route::post('login/store', 'AuthenticationController@store')->name('login.store');

        Route::get('/expired', 'UserController@expiredDate');

    // Middleware
    Route::group(['middleware' => ['auth']], function () {
        // Dashboard
//        Route::get('dashboard', 'UserController@index')->name('dashboard');
        Route::get('dashboard', function () {
            return redirect()->route('users');
        })->name('dashboard');


        // Logout
        Route::get('logout', 'AuthenticationController@logout')->name('logout');

        //  //////////////////////////////////////////////////////////////////////////
  Route::get('/dashboard/update-login-info', 'AuthController@update_date');
        // Users
        Route::get('users', 'UserController@index')->name('users');
        Route::post('users/show', 'UserController@show')->name('users.show');

        // Clicks
        Route::get('clicks/{key}/{userId?}', 'ClickCountsController@index')->name('clicks');
        Route::post('clicks/show', 'ClickCountsController@show')->name('clicks.show');

        // Paid Features
        Route::get('paid-features', 'PaidFeaturesController@index')->name('paid.features');
        Route::post('paid-features/store', 'PaidFeaturesController@store')->name('paid.features.store');

        // Ads
        Route::get('advertisements', 'AdvertisementController@index')->name('advertisements');
        Route::post('advertisements/store', 'AdvertisementController@store')->name('advertisements.store');

        // Plan
        Route::get('plans', 'PlanController@index')->name('plans');
        Route::post('plans/store', 'PlanController@store')->name('plans.store');

        // Send Notification
        Route::get('notifications', 'NotificationController@index')->name('notifications');
        Route::post('notifications/store-image', 'NotificationController@storeImage')->name('notifications.store.image');

    });
});
