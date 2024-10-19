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
        if (! auth()->check() || ! auth()->user()->is_councillor) {
            return redirect()->back()->with('error', 'You must be a councillor to answer questions');
        }

        $locality = $question->locality;

        return view('answers.create', compact('question', 'locality'));
    }

    public function store(StoreAnswerRequest $request): RedirectResponse
    {
        Answer::create($request->validated());

        return redirect()->back()->with('success', 'Answer created successfully');
    }

    public function update(UpdateAnswerRequest $request, Answer $answer): RedirectResponse
    {
        $answer->update($request->validated());

        return redirect()->back()->with('success', 'Answer updated successfully');
    }

    public function destroy(Answer $answer): RedirectResponse
    {
        $answer->delete();

        return redirect()->back()->with('success', 'Answer deleted successfully');
    }
}
