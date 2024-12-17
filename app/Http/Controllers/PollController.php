<?php

namespace App\Http\Controllers;

use App\Http\Requests\VoteRequest;
use App\Models\Poll;
use Inertia\Inertia;

class PollController extends Controller
{
    public function index()
    {
        $polls = Poll::with('options', 'user')->paginate(20);

        return Inertia::render('Poll/Index', ['polls' => $polls]);
    }

    public function show(int $id)
    {
        $poll = Poll::with('options')->where('id', $id)->firstOrFail();

        $alreadyVoted = (boolean)$poll->votes()->where('user_id', auth()->id())->count();

        return Inertia::render('Poll/Show', ['poll' => $poll, 'alreadyVoted' => $alreadyVoted]);
    }

    public function destroy(int $id)
    {
        //TODO needs gating

        $poll = Poll::where('id', $id)->firstOrFail();

        $poll->delete();
    }

    public function vote(int $id, VoteRequest $request)
    {
        //TODO: needs preventing multiple voting
        $poll = Poll::where('id', $id)->firstOrFail();
        $poll->votes()->create(['user_id' => auth()->id()]);

        return redirect()->route('polls.show', $poll);
    }
}
