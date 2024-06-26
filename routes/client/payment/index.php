<?php

use Illuminate\Support\Facades\Route;

Route::name('vnpay.')->prefix('/vnpay')->group(function () {
    Route::get('/return', [\App\Modules\Admin\Payment\Http\VnPay::class, 'vnpay_return'])->name('vnpay_return');
});
