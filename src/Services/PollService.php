<?php

namespace src\Services;

use App\Http\Requests\PollRequest;
use App\Http\Requests\VoteRequest;
use App\Models\Poll;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class PollService
{

    public function store(PollRequest $request): void
    {
        $poll = $request->user()->polls()->create($request->validated());

        $options = array_map(function ($item) {
            return ['title' => $item];
        }, $request->options);

        $poll->options()->createMany($options);

    }

    public function destroy(Poll $poll): void
    {
        Gate::authorize('delete', $poll);
        $poll->delete();
    }

    public function vote(VoteRequest $request, Poll $poll): void
    {
        DB::beginTransaction();
        try {
            $option = $poll->options()->where('id', $request->option)->firstOrFail();
            $option->increment('count');

            $poll->votes()->create(['user_id' => auth()->id()]);

            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            throw $exception;
        }

    }
}
