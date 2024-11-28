<?php

use GuzzleHttp\RequestOptions;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Laravel\Socialite\Facades\Socialite;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
});


Route::get('/auth/redirect', function () {
    return Socialite::driver('discord')
        ->scopes(['identify', 'email', 'guilds'])
        ->redirect();
});

Route::get('/auth/callback', function () {
    $user = Socialite::driver('discord')
        ->scopes(['identify', 'email', 'guilds'])
        ->user();
    dump($user);

    $response = \Illuminate\Support\Facades\Http::withHeaders([
        'Authorization' => 'Bearer ' . $user->token,
    ])->get('https://discord.com/api/users/@me/guilds');
    dd($response->json());
    dump($user);
    // $user->token
});

