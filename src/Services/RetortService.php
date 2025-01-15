<?php

namespace src\Services;

use App\Http\Requests\RetortRequest;
use App\Models\Retort;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class RetortService
{

    public function store(RetortRequest $request)
    {
        $post = new Retort();
        $post->user_id = Auth::id();
        $post->question = $request->question;

        $post->save();
    }

    public function destroy(Retort $retort)
    {
        Gate::authorize('delete', $retort);

        $retort->delete();
    }

    public function downloadableString(): string
    {
        $retorts = Retort::all()->shuffle();


        $card = "cardName = \"Last Retort: The custom card.\"\n";
        $card .= "promptList = {\n";
        foreach ($retorts as $retort) {
            $card .= "\"$retort->question\",\n";
        }
        $card .= '}';


        return $card;
    }
}
