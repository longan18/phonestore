<?php

use App\Modules\ShoppingCart\Http\Controllers\ShoppingCartController;
use Illuminate\Support\Facades\Route;

Route::get('/cart', [ShoppingCartController::class, 'index'])->name('cart.index');
Route::post('/add-cart', [ShoppingCartController::class, 'addCart'])->name('add-cart');
Route::post('/delete-item-cart', [ShoppingCartController::class, 'deleteItemCart'])->name('delete-item-cart');
Route::post('/update-item-cart', [ShoppingCartController::class, 'updateCart'])->name('update-item-cart');
