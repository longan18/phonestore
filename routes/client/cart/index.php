<?php

use App\Modules\ShoppingCart\Http\Controllers\ShoppingCartController;
use Illuminate\Support\Facades\Route;

Route::post('add-cart', [ShoppingCartController::class, 'addCart'])->name('add-cart');
