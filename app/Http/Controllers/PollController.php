<?php

namespace App\Http\Controllers;

use App\Models\Poll;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PollController extends Controller
{
    public function browse()
    {
        $polls = Poll::paginate(20);

        return Inertia::render('Poll/Browse', ['polls' => $polls]);
    }

    public function read(int $id)
    {
        $poll = Poll::where('id', $id)->firstOrFail();
    }

    public function delete(int $id)
    {
        $poll = Poll::where('id', $id)->firstOrFail();
    }
}
