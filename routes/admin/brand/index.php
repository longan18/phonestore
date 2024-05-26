<?php

use App\Modules\Admin\Brand\Http\Controllers\BrandController;
use Illuminate\Support\Facades\Route;

Route::prefix('brands')
    ->name('brands.')
    ->group(function ()
    {
        Route::get('/', [BrandController::class, 'index'])->name('index');
        Route::post('/', [BrandController::class, 'handle'])->name('handle');
        Route::view('/create', 'admin.brand.form')->name('create');
        Route::get('/{brand}/show', [BrandController::class, 'show'])->name('show');
        Route::delete('/{brand}', [BrandController::class, 'delete'])->name('delete');
    }
);

