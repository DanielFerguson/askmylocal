<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreQuestionRequest;
use App\Http\Requests\UpdateQuestionRequest;
use App\Models\Question;
use Illuminate\Http\RedirectResponse;

class QuestionController extends Controller
{
    public function store(StoreQuestionRequest $request): RedirectResponse
    {
        Question::create($request->validated());

        return redirect()->back()->with('success', 'Question created successfully');
    }

    public function update(UpdateQuestionRequest $request, Question $question): RedirectResponse
    {
        $question->update($request->validated());

        return redirect()->back()->with('success', 'Question updated successfully');
    }

    public function destroy(Question $question): RedirectResponse
    {
        $question->delete();

        return redirect()->back()->with('success', 'Question deleted successfully');
    }
}
