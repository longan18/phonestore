<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::namespace('admin')->group(
    function () {
        Route::group(['middleware' => ['auth:admin']], function () {
            includeRouteFiles(__DIR__.'/admin/dashboard');
        });

        Route::group(['prefix' => '/'],function () {
            includeRouteFiles(__DIR__.'/admin/auth/');
        });
    }
);
