<?php

namespace App\Http\Controllers;


use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Laravel\Socialite\Two\User as ProviderUser;

class SocialLoginController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('discord')
            ->scopes(['identify', 'email', 'guilds'])
            ->redirect();

    }


    public function callback(Request $request)
    {
        $user = Socialite::driver('discord')
            ->user();

        $this->abortIfNoGuild($user);

        $user = User::firstOrCreate([
            'discord_id' => $user->id,
        ], [
            'name' => $user->user['global_name'],
            'email' => $user->email,
            'discord_id' => $user->id,
        ]);

        Auth::login($user);

        return redirect()->route('dashboard');
    }


    protected function abortIfNoGuild($user)
    {
        $response = \Illuminate\Support\Facades\Http::withHeaders([
            'Authorization' => 'Bearer ' . $user->token,
        ])->get('https://discord.com/api/users/@me/guilds');

        if ($response->getStatusCode() != 200)
            abort(401, 'wrong response');

        $guilds = $response->json();
        $guild_id = config('app.discord_guild_id');

        foreach ($guilds as $guild) {
            if ($guild['id'] == $guild_id) {
                return true;
            }
        }
        abort(401, 'no guild found');
    }
}
