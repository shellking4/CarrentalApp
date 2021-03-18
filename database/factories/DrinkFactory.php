<?php

namespace Database\Factories;

use App\Models\Drink;
use Illuminate\Database\Eloquent\Factories\Factory;

class DrinkFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Drink::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $imageDir = 'public/drImages/';
        $images = glob($imageDir . '*.{jpeg, jpg, png, gif}', GLOB_BRACE);
        $randomImage = $images[array_rand($images)];
        return [
            'name' => $this->faker->text(20),
            'description' => $this->faker->text,
            'image' => $this->faker->image(),
            'price' => $this->faker->randomFloat(5)
        ];
    }
}
