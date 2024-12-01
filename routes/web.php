<?php

use App\Http\Controllers\SocialLoginController;
use Illuminate\Support\Facades\Route;

Route::get(\App\Http\Controllers\LandingController::class)->name('home');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', \App\Http\Controllers\DashBoardController::class)->name('dashboard');
});


Route::get('/auth/redirect', [SocialLoginController::class, 'redirect'])->name('login');

Route::get('/auth/callback', [SocialLoginController::class, 'callback']);

