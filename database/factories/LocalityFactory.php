<?php

namespace Database\Factories;

use App\Models\Locality;
use Illuminate\Database\Eloquent\Factories\Factory;

class LocalityFactory extends Factory
{
    protected $model = Locality::class;

    public function definition()
    {
        return [
            'state' => $this->faker->state(),
            'name' => $this->faker->city(),
        ];
    }
}
