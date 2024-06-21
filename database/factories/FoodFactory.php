<?php

namespace Database\Factories;

use App\Models\Food;
use Illuminate\Database\Eloquent\Factories\Factory;

class FoodFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Food::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->unique()->word(), // Use 'word' for a random food name
            'price' => $this->faker->numberBetween(5, 20),
            'description' => $this->faker->sentence(6, true),
            'type' => $this->faker->randomElement(['Western', 'Chinese', 'Japanese']),
            'picture' => $this->faker->imageUrl(640, 480, 'food', true), // Specify 'food' for image category
        ];
    }
}
