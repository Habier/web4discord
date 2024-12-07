<?php

namespace App\Http\Controllers;

use App\Http\Requests\RetortRequest;
use App\Models\Retort;
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
}
