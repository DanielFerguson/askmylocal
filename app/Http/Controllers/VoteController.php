<?php

namespace App\Http\Controllers;

use App\Models\Vote;
use Illuminate\Http\Request;

class VoteController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $request->validate([
            'voteable_id' => 'required|integer',
            'voteable_type' => 'required|in:App\Models\Question,App\Models\Answer',
            'direction' => 'required|in:up,down',
        ]);

        Vote::updateOrCreate([
            'voteable_id' => $request->voteable_id,
            'voteable_type' => $request->voteable_type,
            'voter_id' => auth()->id(),
        ], [
            'direction' => $request->direction,
        ]);

        return back()->with('success', 'Vote cast successfully');
    }
}
