<?php

namespace App\Http\Controllers;

use App\Http\Requests\PollRequest;
use App\Http\Requests\VoteRequest;
use App\Models\Poll;
use Inertia\Inertia;
use src\Services\PollService;

class PollController extends Controller
{
    public function __construct(private PollService $pollService)
    {
    }

    public function index()
    {
        $polls = Poll::with('options', 'user')->paginate(20);

        return Inertia::render('Poll/Index', ['polls' => $polls]);
    }

    public function show(Poll $poll)
    {
        $poll->load('options');
        $alreadyVoted = $poll->userAlreadyVoted(auth()->user());

        return Inertia::render('Poll/Show', ['poll' => $poll, 'alreadyVoted' => $alreadyVoted]);
    }

    public function create()
    {
        return Inertia::render('Poll/Create');
    }

    public function store(PollRequest $request)
    {
        $this->pollService->store($request);
        return redirect()->route('polls.index');
    }

    public function destroy(Poll $poll)
    {
        $this->pollService->destroy($poll);

        return redirect()->route('polls.index');
    }

    public function vote(VoteRequest $request, Poll $poll)
    {
        $this->pollService->vote($request, $poll);

        return redirect()->route('polls.show', $poll);
    }
}
