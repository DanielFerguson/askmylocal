<?php

namespace Database\Factories;

use App\Models\Answer;
use App\Models\Question;
use App\Models\User;
use App\Models\Vote;
use Illuminate\Database\Eloquent\Factories\Factory;

class VoteFactory extends Factory
{
    protected $model = Vote::class;

    public function definition()
    {
        $voteable = $this->faker->randomElement([
            Question::class,
            Answer::class,
        ]);

        return [
            'voter_id' => User::factory(),
            'voteable_id' => $voteable::factory(),
            'voteable_type' => $voteable,
            'direction' => $this->faker->randomElement(['up', 'down']),
        ];
    }
}
