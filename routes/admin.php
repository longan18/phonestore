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
            includeRouteFiles(__DIR__.'/admin/customer');
            includeRouteFiles(__DIR__.'/admin/address');
            includeRouteFiles(__DIR__.'/admin/dashboard');
            includeRouteFiles(__DIR__.'/admin/brand');
            includeRouteFiles(__DIR__.'/admin/product');
        });

        Route::group(['prefix' => '/'],function () {
            includeRouteFiles(__DIR__.'/admin/auth/');
        });
    }
);
