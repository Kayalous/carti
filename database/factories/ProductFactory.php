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
            'name' => $this->faker->name,
            'image' => '/images/product-' . $this->faker->numberBetween(1, 5) . '.jpg',
            'description' => $this->faker->paragraph,
            'qty' => $this->faker->numberBetween(1, 999),
            'weight' => $this->faker->randomFloat(2, 1, 10),
            'price' => $this->faker->randomFloat(2, 1, 1000),
            'merchant_id' => 2
        ];
    }
}
