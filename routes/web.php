<?php

use Illuminate\Support\Facades\Route;

Route::name('client.')->group(
    function () {
        includeRouteFiles(__DIR__.'/client/auth');
        includeRouteFiles(__DIR__.'/client/home');
        includeRouteFiles(__DIR__.'/client/product');
        includeRouteFiles(__DIR__.'/client/cart');

        Route::group(['middleware' => ['auth:web']], function () {
            includeRouteFiles(__DIR__.'/client/infor/');
        });
    }
);
