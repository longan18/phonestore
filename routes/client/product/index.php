<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Client\Shop\Http\Controllers\ShopController;

Route::get('/{product:slug}', [ShopController::class, 'showProductDetail'])->name('product.detail');
Route::post('/option-price', [ShopController::class, 'getOptionPriceProductDetail'])->name('product.option-price');
