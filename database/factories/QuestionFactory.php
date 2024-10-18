<?php

namespace Database\Factories;

use App\Models\Locality;
use App\Models\Question;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class QuestionFactory extends Factory
{
    protected $model = Question::class;

    public function definition()
    {
        return [
            'asked_by_id' => User::factory(),
            'locality_id' => Locality::factory(),
            'value' => $this->faker->sentence(10).'?',
        ];
    }
}
