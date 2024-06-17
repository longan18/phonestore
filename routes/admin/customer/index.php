<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Admin\Customer\Http\Controllers\CustomerController;

Route::prefix('customer')->name('customer.')->group(function () {
    Route::get('/', [CustomerController::class, 'index'])->name('index');
    Route::get('/create', [CustomerController::class, 'create'])->name('create');
    Route::get('/{user:id}/infor', [CustomerController::class, 'showInfor'])->name('show-infor');
    Route::post('/store-customer', [CustomerController::class, 'store'])->name('store');
    Route::post('/{user:id}/update-customer', [CustomerController::class, 'update'])->name('update');
});
