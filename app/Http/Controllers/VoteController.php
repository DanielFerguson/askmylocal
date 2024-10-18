<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreVoteRequest;
use App\Http\Requests\UpdateVoteRequest;
use App\Models\Vote;

class VoteController extends Controller
{
    public function store(StoreVoteRequest $request)
    {
        Vote::create($request->validated());

        return redirect()->back()->with('success', 'Vote created successfully');
    }

    public function update(UpdateVoteRequest $request, Vote $vote)
    {
        $vote->update($request->validated());

        return redirect()->back()->with('success', 'Vote updated successfully');
    }

    public function destroy(Vote $vote)
    {
        $vote->delete();

        return redirect()->back()->with('success', 'Vote deleted successfully');
    }
}
