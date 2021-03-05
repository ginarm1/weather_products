<?php

namespace Database\Factories;

use App\Models\Product;
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
//            'id' => $this->faker->unique()->randomDigit,
            'sku'=> $this->faker->unique()->regexify('[A-Za-z0-9]{5}'),
            'name'=> $this->faker->unique()->word,
            'cost'=> $this->faker->randomFloat(4,0.99,30),
        ];
    }
}
