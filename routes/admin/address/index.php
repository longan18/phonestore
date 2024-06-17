<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Admin\Address\Http\Controllers\AddressController;

Route::prefix('address')->name('address.')->group(function () {
    Route::get('/{user:id}/list', [AddressController::class, 'index'])->name('index');
});
