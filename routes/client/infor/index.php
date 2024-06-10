<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Client\Profile\Http\Controllers\ProfileController;
use App\Modules\Client\Account\Http\Controllers\AccountController;

Route::name('infor.')->prefix('/infor')->group(function () {
    Route::get('{user:id}/detail', [ProfileController::class, 'show'])->name('index');
    Route::post('/update', [AccountController::class, 'update'])->name('update');
});
