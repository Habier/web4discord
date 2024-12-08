<?php

namespace App\Http\Controllers;

use App\Http\Requests\RetortRequest;
use App\Models\Retort;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class RetortController extends Controller
{
    public function browse()
    {
        $retorts = Retort::where('user_id', Auth::id())->get();
        return Inertia::render('Retort/Main', ['retorts' => $retorts]);
    }

    public function browseAll()
    {
        $retorts = Retort::all();
        return view('retorts.complete', ['retorts' => $retorts]);
    }

    public function add(RetortRequest $request): RedirectResponse
    {
        $post = new Retort();
        $post->user_id = Auth::id();
        $post->question = $request->question;

        $post->save();
        return redirect()->action([RetortController::class, 'browse']);
    }

    /**
     * @param Request $request
     * @param $id
     * @return RedirectResponse
     */
    public function delete(Request $request, $id)
    {
        $post = Retort::where('user_id', Auth::id())->where('id', $id)->firstOrFail();
        $post->delete();

        return redirect()->route('retorts.index');
    }

    public function download(Request $request)
    {
        $retorts = Retort::all()->shuffle();
        $latestRetort = Retort::latest()->first();

        $card = "cardName = \"Last Retort: The custom card.\"\n";
        $card .= "promptList = {\n";
        foreach ($retorts as $retort) {
            $card .= "\"$retort->question\",\n";
        }
        $card .= '}';

        return response($card)->withHeaders([
            'Content-Type' => 'text/plain',
            'Cache-Control' => 'no-store, no-cache',
            'Content-Disposition' => 'attachment; filename="last_retort_custom_card_' . $latestRetort->created_at->toDateTimeString() . '.txt',
        ]);
    }
}
