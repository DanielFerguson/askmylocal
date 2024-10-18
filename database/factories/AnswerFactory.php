<?php

namespace Database\Factories;

use App\Models\Answer;
use App\Models\Question;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class AnswerFactory extends Factory
{
    protected $model = Answer::class;

    public function definition()
    {
        return [
            'question_id' => Question::factory(),
            'answered_by_id' => User::factory()->state(['is_councillor' => true]),
            'value' => $this->faker->paragraph(),
        ];
    }
}
