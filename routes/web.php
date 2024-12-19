<?php

use App\Http\Controllers\SocialLoginController;
use Illuminate\Support\Facades\Route;

Route::get('/', \App\Http\Controllers\LandingController::class)->name('home');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', \App\Http\Controllers\DashBoardController::class)->name('dashboard');

    Route::get('/retorts/download', [\App\Http\Controllers\RetortController::class, 'download'])->name('retorts.download');
    Route::resource('retorts', \App\Http\Controllers\RetortController::class);

    Route::post("/polls/{poll}/vote", [\App\Http\Controllers\PollController::class, 'vote'])->name('polls.vote');
    Route::resource('polls', \App\Http\Controllers\PollController::class);


    Route::post('/logout', [\Laravel\Fortify\Http\Controllers\AuthenticatedSessionController::class, 'destroy'])->name('logout');
});


Route::get('/discord/login', [SocialLoginController::class, 'redirect'])->name('login');

Route::get('/auth/callback', [SocialLoginController::class, 'callback']);

