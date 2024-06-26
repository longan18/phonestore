<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [\App\Modules\Admin\Home\Http\Controllers\HomeController::class, 'index'])->name('admin.dashboard.index');
