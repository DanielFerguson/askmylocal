<?php

namespace App\Http\Requests;

use App\Models\Answer;
use App\Models\Question;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreVoteRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'voteable_id' => 'required|integer',
            'voteable_type' => [
                'required',
                Rule::in([
                    Question::class,
                    Answer::class,
                ]),
            ],
            'direction' => 'required|in:up,down',
        ];
    }
}
