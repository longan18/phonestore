<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Client\Account\Http\Controllers\AccountController;

Route::middleware(['guest:web'])->group(function () {
    Route::get('/sign-in', [AccountController::class, 'pageLogin'])->name('page-login');
    Route::get('/sign-up', [AccountController::class, 'pageRegister'])->name('page-register');


    Route::post('/register', [AccountController::class, 'register'])->name('register');
    Route::post('/login', [AccountController::class, 'login'])->name('login');
    Route::get('/forgot-password', [AccountController::class, 'forgotPassword'])->name('forgot-password');
    Route::post('/forgot-password-send-email', [AccountController::class, 'forgotPasswordSendEmail'])->name('forgot-password-send-email');
});


Route::get('/logout', [AccountController::class, 'logout'])
    ->middleware('auth:web')
    ->name('logout');
