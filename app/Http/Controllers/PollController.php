<?php

namespace App\Http\Controllers;

use App\Models\Poll;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PollController extends Controller
{
    public function index()
    {
        $polls = Poll::paginate(20);

        return Inertia::render('Poll/Browse', ['polls' => $polls]);
    }

    public function show(int $id)
    {
        $poll = Poll::where('id', $id)->firstOrFail();
    }

    public function destroy(int $id)
    {
        $poll = Poll::where('id', $id)->firstOrFail();
    }
}
