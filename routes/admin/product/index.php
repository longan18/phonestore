<?php

use App\Modules\Admin\ {
    ProductSmartphone\Http\Controllers\ProductSmartphoneController,
    ProductSmartphonePrice\Http\Controllers\ProductSmartphonePriceController
};

use Illuminate\Support\Facades\Route;

// product smartphone
Route::prefix('product-smartphone')->name('smartphone.')->group(function () {
    // smartphone.index
    Route::get('/', [ProductSmartphoneController::class, 'index'])->name('index');
    // smartphone.create
    Route::get('/create', [ProductSmartphoneController::class, 'create'])->name('create');
    // smartphone.store
    Route::post('/', [ProductSmartphoneController::class, 'store'])->name('store');
    // smartphone.show
    Route::get('/{product:slug}/show', [ProductSmartphoneController::class, 'show'])->name('show');
    // smartphone.update
    Route::post('/update', [ProductSmartphoneController::class, 'update'])->name('update');
});

// product smartphone option
Route::prefix('product-smartphone')->name('smartphone.option.')->group(function () {
    // smartphone.option.store
    Route::post('/option', [ProductSmartphonePriceController::class, 'store'])->name('store');
    // smartphone.option.update
    Route::post('/option/update', [ProductSmartphonePriceController::class, 'update'])->name('update');
    // smartphone.option.index
    Route::get('/{product:slug}/options', [ProductSmartphonePriceController::class, 'index'])->name('index');
    // smartphone.option.create
    Route::get('/{product:slug}/option/create', [ProductSmartphonePriceController::class, 'create'])->name('create');
    // smartphone.option.show
    Route::get('/{product:slug}/option/{option:id}/show', [ProductSmartphonePriceController::class, 'show'])->name('show');
});
