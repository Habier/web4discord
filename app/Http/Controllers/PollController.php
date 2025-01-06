<?php

namespace App\Http\Controllers;

use App\Http\Requests\PollRequest;
use App\Http\Requests\VoteRequest;
use App\Models\Poll;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;

class PollController extends Controller
{
    public function index()
    {
        $polls = Poll::with('options', 'user')->paginate(20);

        return Inertia::render('Poll/Index', ['polls' => $polls]);
    }

    public function show(Poll $poll)
    {
        $poll->load('options');
        $alreadyVoted = (boolean)$poll->votes()->where('user_id', auth()->id())->count();

        return Inertia::render('Poll/Show', ['poll' => $poll, 'alreadyVoted' => $alreadyVoted]);
    }

    public function create()
    {
        return Inertia::render('Poll/Create');
    }

    public function store(PollRequest $request)
    {
        $poll = $request->user()->polls()->create($request->validated());

        $options = array_map(function ($item) {
            return ['title' => $item];
        }, $request->options);

        $poll->options()->createMany($options);

        return redirect()->route('polls.index');
    }

    public function destroy(Request $request, Poll $poll)
    {
        Gate::authorize('delete', $poll);

        $request->user()->cannot('delete', $poll);
        $poll->delete();

        return redirect()->route('polls.index');
    }

    public function vote(VoteRequest $request, Poll $poll)
    {
        $poll->votes()->create(['user_id' => $request->user()->id]);

        return redirect()->route('polls.show', $poll);
    }
}
