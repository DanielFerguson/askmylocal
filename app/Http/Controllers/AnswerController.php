<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAnswerRequest;
use App\Http\Requests\UpdateAnswerRequest;
use App\Models\Answer;
use Illuminate\Http\RedirectResponse;

class AnswerController extends Controller
{
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
