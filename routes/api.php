<?php

use App\Http\Controllers\Api\PostController;
use Illuminate\Support\Facades\Route;

Route::middleware(['api', 'device.detect'])->group(function () {
    Route::get('/posts', [PostController::class, 'index']);
});
