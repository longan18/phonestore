<?php

use App\Modules\Client\Address\Http\Controllers\AddressController;
use Illuminate\Support\Facades\Route;

Route::name('address.')->prefix('/address-shipping')->group(function () {
    Route::get('/', [AddressController::class, 'index'])->name('index');
    Route::post('/get-district', [AddressController::class, 'getDistrictByProvince'])->name('get-district');
    Route::post('/get-ward', [AddressController::class, 'getWardByDistrict'])->name('get-ward');
    Route::post('/store-address-shipping', [AddressController::class, 'storeAddress'])->name('store-address-shipping');
    Route::post('/delete-address-shipping', [AddressController::class, 'removeAddress'])->name('delete-address-shipping');
    Route::post('/active-address-shipping', [AddressController::class, 'activeAddress'])->name('active-address-shipping');
});
