<?php

namespace App\Http\Controllers;

use App\Models\Retort;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class RetortController extends Controller
{
    public function index()
    {
        $retorts = Retort::where('user_id', Auth::id())->get();
        //return Inertia::render('Retort/Main');
        return view('retorts.index', ['retorts' => $retorts]);
    }

    public function save(Request $request): \Illuminate\Http\RedirectResponse
    {
        $post = new Retort();
        $post->user_id = Auth::id();
        $post->question = $request->question;

        $post->save();
        return redirect()->action('RetortController@index');
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function delete(Request $request, $id): \Illuminate\Http\RedirectResponse
    {
        $post = Retort::where('user_id', Auth::id())->where('id', $id)->firstOrFail();
        $post->delete();

        return redirect()->action('RetortController@index');
    }

    public function list()
    {
        $retorts = Retort::all();
        return view('retorts.complete', ['retorts' => $retorts]);
    }
}
