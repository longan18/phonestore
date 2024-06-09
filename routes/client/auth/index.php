<?php

use Illuminate\Support\Facades\Route;

Route::view('/login', 'client.auth.login')->name('page-login');
Route::view('/register', 'client.auth.register')->name('page-register');
