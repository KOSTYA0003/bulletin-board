<?php

use App\Http\Controllers\Admin\AdvertisementController as AdminAdvertisementController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AdvertisementController;
use App\Http\Controllers\Auth\EmailVerificationController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AdvertisementController::class, 'index'])->name('home');
Route::get('/advertisements', [AdvertisementController::class, 'index'])->name('advertisements.index');
Route::get('/advertisements/all', [AdvertisementController::class, 'allAdvertisements'])->name('advertisements.all');

Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
Route::get('/categories/{category}', [CategoryController::class, 'show'])->name('categories.show');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register.submit');

Route::middleware(['auth'])->group(function () {
    Route::get('/advertisements/create', [AdvertisementController::class, 'create'])->name('advertisements.create');
    Route::post('/advertisements', [AdvertisementController::class, 'store'])->name('advertisements.store');
    Route::get('/advertisements/{advertisement}/edit', [AdvertisementController::class, 'edit'])->name('advertisements.edit');
    Route::put('/advertisements/{advertisement}', [AdvertisementController::class, 'update'])->name('advertisements.update');
    Route::delete('/advertisements/{advertisement}', [AdvertisementController::class, 'destroy'])->name('advertisements.destroy');
    Route::get('/my-advertisements', [AdvertisementController::class, 'myAdvertisements'])->name('advertisements.my');
}); //

Route::get('/advertisements/{advertisement}', [AdvertisementController::class, 'show'])->name('advertisements.show'); // +

Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', [AdminAdvertisementController::class, 'dashboard'])->name('admin.dashboard');

    Route::prefix('users')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('admin.users.index');
        Route::get('/{user}/edit', [UserController::class, 'edit'])->name('admin.users.edit');
        Route::put('/{user}', [UserController::class, 'update'])->name('admin.users.update');
        Route::post('/{user}/ban', [UserController::class, 'ban'])->name('admin.users.ban');
        Route::post('/{user}/unban', [UserController::class, 'unban'])->name('admin.users.unban');
        Route::post('/{user}/make-admin', [UserController::class, 'makeAdmin'])->name('admin.users.make-admin');
        Route::post('/{user}/make-user', [UserController::class, 'makeUser'])->name('admin.users.make-user');
    });

    Route::prefix('advertisements')->group(function () {
        Route::get('/', [AdminAdvertisementController::class, 'index'])->name('admin.advertisements.index');
        Route::get('/{advertisement}', [AdminAdvertisementController::class, 'show'])->name('admin.advertisements.show');
        Route::get('/{advertisement}/edit', [AdminAdvertisementController::class, 'edit'])->name('admin.advertisements.edit');
        Route::put('/{advertisement}', [AdminAdvertisementController::class, 'update'])->name('admin.advertisements.update');
        Route::post('/{advertisement}/reject', [AdminAdvertisementController::class, 'reject'])->name('admin.advertisements.reject');
        Route::post('/{advertisement}/approve', [AdminAdvertisementController::class, 'approve'])->name('admin.advertisements.approve');
    });
});

Route::post('/email/verify', [EmailVerificationController::class, 'sendVerificationEmail'])
    ->middleware('auth')
    ->name('verification.send');

Route::get('/email/verify/{token}', [EmailVerificationController::class, 'verify'])
    ->name('verification.verify');
