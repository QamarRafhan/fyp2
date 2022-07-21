<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{

    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        return [
            'name' => $this->faker->userName(),
            'description' => $this->faker->text(),
            'min_width' => $this->faker->numberBetween(100, 200),
            'max_width' => $this->faker->numberBetween(300, 400),
            'min_length' => $this->faker->numberBetween(300, 400),
            'max_length' => $this->faker->numberBetween(800, 900),
        ];
    }
}
