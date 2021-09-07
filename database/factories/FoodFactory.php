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
        $imageDir = 'public/fdImages/';
        $images = glob($imageDir . '*.{jpeg, jpg, png, gif}', GLOB_BRACE);
        $randomImage = $images[array_rand($images)];
        return [
            'name' => $this->faker->text(20),
            'description' => $this->faker->text,
            'image' => $this->faker->image(),
            'price' => $this->faker->randomFloat(4)
        ];
    }
}
