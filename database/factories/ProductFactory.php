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
            'sku' => $this->faker->word,
        'name' => $this->faker->word,
        'slug' => $this->faker->word,
        'price' => $this->faker->randomDigitNotNull,
        'compare_price' => $this->faker->randomDigitNotNull,
        'product_type' => $this->faker->word,
        'vendor_id' => $this->faker->word,
        'status' => $this->faker->word,
        'description' => $this->faker->word,
        'default_img' => $this->faker->word,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
