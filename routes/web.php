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

    Route::get('/retorts', [\App\Http\Controllers\RetortController::class, 'browse'])->name('retorts.index');
    Route::post('/retorts', [\App\Http\Controllers\RetortController::class, 'add'])->name('retorts.add');
    Route::delete('/retort/{id}', [\App\Http\Controllers\RetortController::class, 'delete'])->name('retorts.delete');
    Route::get('/retorts/download', [\App\Http\Controllers\RetortController::class, 'download'])->name('retorts.download');


    Route::post('/logout', [\Laravel\Fortify\Http\Controllers\AuthenticatedSessionController::class, 'destroy'])->name('logout');
});


Route::get('/auth/redirect', [SocialLoginController::class, 'redirect'])->name('login');

Route::get('/auth/callback', [SocialLoginController::class, 'callback']);

