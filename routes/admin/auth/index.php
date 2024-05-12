<?php

use App\Modules\Admin\Account\Http\Controllers\AccountController;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => '/login',
    'middleware' => ['guest:admin']
], function () {
    Route::view('/', 'admin.auth.login')->name('admin.page-login');
    Route::post('/', [AccountController::class, 'login'])->name('admin.login');
});

Route::get('/logout', [AccountController::class, 'logout'])
    ->middleware('auth:admin')
    ->name('admin.logout');
