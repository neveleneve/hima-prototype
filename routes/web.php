<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::middleware(['guest'])->group(function () {
    Route::post('login', [AuthController::class, 'login']);
});

Route::inertia('/', 'Welcome');

Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::inertia('/', 'Authenticated/Admin');
    Route::resource('pengguna', UserController::class);
    Route::post('logout', [AuthController::class, 'logout']);
});
