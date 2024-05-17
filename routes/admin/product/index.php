<?php

use App\Modules\Admin\ProductSmartphone\Http\Controllers\ProductSmartphoneController;
use Illuminate\Support\Facades\Route;

Route::prefix('product-smartphone')->name('smartphone.')->group(function () {
    Route::get('/', [ProductSmartphoneController::class, 'index'])->name('index');
    Route::post('/', [ProductSmartphoneController::class, 'handle'])->name('handle');
    Route::get('/create', [ProductSmartphoneController::class, 'create'])->name('create');
    Route::get('/{product:slug}/show', [ProductSmartphoneController::class, 'show'])->name('show');
    Route::get('/{product:slug}/options', [ProductSmartphoneController::class, 'getListOption'])->name('show-list-option');
    Route::get('/{product:slug}/option/create', [ProductSmartphoneController::class, 'createOption'])->name('create-option');
    Route::get('/{product:slug}/option/{id}/show', [ProductSmartphoneController::class, 'showOption'])->name('create-option');
});
