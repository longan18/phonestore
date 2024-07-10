<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Notification\Http\Controllers\NotificationController;

Route::name('notifi.')->prefix('/notifi')->group(function () {
    Route::post('/update-noti', [NotificationController::class, 'update'])->name('update');
});
