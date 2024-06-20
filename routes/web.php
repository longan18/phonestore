<?php

use Illuminate\Support\Facades\Route;

Route::name('client.')->group(
    function () {
        Route::group(['middleware' => ['auth:web']], function () {
            includeRouteFiles(__DIR__.'/client/cart');
            includeRouteFiles(__DIR__.'/client/address/');
            includeRouteFiles(__DIR__.'/client/infor/');
        });

        includeRouteFiles(__DIR__.'/client/auth');
        includeRouteFiles(__DIR__.'/client/home');
        includeRouteFiles(__DIR__.'/client/product');
    }
);
