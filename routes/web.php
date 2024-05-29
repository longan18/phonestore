<?php

use Illuminate\Support\Facades\Route;

Route::group(
    [
        'prefix'     => '/',
        'as'         => 'client.',
    ],
    function () {


//        Route::group(['middleware' => ['auth:web']], function () {
//            includeRouteFiles(__DIR__.'/client/cart/');
//        });
    }
);

Route::name('client.')->group(
    function () {
        includeRouteFiles(__DIR__.'/client/home');
    }
);
