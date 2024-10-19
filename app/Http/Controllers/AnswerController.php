<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAnswerRequest;
use App\Http\Requests\UpdateAnswerRequest;
use App\Models\Answer;
use App\Models\Question;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AnswerController extends Controller
{
    public function create(Question $question): View
    {
        // If the user is not a councillor, redirect back with an error message
        if (! auth()->check() || ! auth()->user()->is_councillor) {
            return redirect()->back()->with('error', 'You must be a councillor to answer questions');
        }

        // Check that the question is in the same locality as the user
        if ($question->locality_id !== auth()->user()->locality_id) {
            return redirect()->back()->with('error', 'You can only answer questions in your locality');
        }

        $locality = $question->locality;

        return view('answers.create', compact('question', 'locality'));
    }

    public function store(StoreAnswerRequest $request, Question $question): RedirectResponse
    {
        $question->answers()->create([
            'value' => $request->value,
            'answered_by_id' => auth()->user()->id,
        ]);

        $state = strtolower(str_replace(' ', '-', $question->locality->state));
        $locality = strtolower(str_replace(' ', '-', $question->locality->name));

        return redirect()->route('locality', [$state, $locality])->with('success', 'Answer created successfully');
    }

    public function update(UpdateAnswerRequest $request, Question $question, Answer $answer): RedirectResponse
    {
        $answer->update($request->validated());

        return redirect()->back()->with('success', 'Answer updated successfully');
    }

    public function destroy(Question $question, Answer $answer): RedirectResponse
    {
        $answer->delete();

        return redirect()->back()->with('success', 'Answer deleted successfully');
    }
}
