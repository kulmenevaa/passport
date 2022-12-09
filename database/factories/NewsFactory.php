<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class NewsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->unique()->name,
            'abbreviation' => $this->faker->unique()->name,
            'description' => $this->faker->unique()->text,
            'status' => 1,
            'public_date' => date('Y-m-d H:i:s')
        ];
    }
}
