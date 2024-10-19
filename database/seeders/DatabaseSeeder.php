<?php

namespace Database\Seeders;

use App\Models\Answer;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Locality;
use App\Models\Question;
use App\Models\User;
use App\Models\Vote;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create localities
        $this->call(LocalitySeeder::class);

        // Create 10 localities
        Locality::all()->each(function ($locality) {
            // Create 5-10 users for each locality, including at least one councillor
            User::factory(rand(5, 10))->create(['locality_id' => $locality->id])
                ->each(function ($user, $index) use ($locality) {
                    // Make the first user in each locality a councillor
                    if ($index === 0) {
                        $user->update(['is_councillor' => true]);
                    }

                    // Each user asks 0-3 questions
                    Question::factory(rand(0, 3))->create([
                        'asked_by_id' => $user->id,
                        'locality_id' => $user->locality_id,
                    ])->each(function ($question) use ($locality) {
                        // Each question has 0-2 answers
                        Answer::factory(rand(0, 2))->create([
                            'question_id' => $question->id,
                            'answered_by_id' => User::where('is_councillor', true)
                                ->where('locality_id', $locality->id)
                                ->inRandomOrder()
                                ->firstOrFail()
                                ->id,
                        ]);

                        // Each question has 0-5 votes
                        Vote::factory(rand(0, 5))->create([
                            'voteable_id' => $question->id,
                            'voteable_type' => Question::class,
                        ]);
                    });
                });
        });

        // Add some votes to answers
        Answer::all()->each(function ($answer) {
            Vote::factory(rand(0, 3))->create([
                'voteable_id' => $answer->id,
                'voteable_type' => Answer::class,
            ]);
        });
    }
}
