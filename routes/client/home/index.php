<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Client\Home\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'getDataPageHome'])->name('home');
