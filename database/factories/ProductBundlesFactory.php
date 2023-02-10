<?php

namespace Database\Factories;

use App\Models\ProductBundles;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductBundlesFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ProductBundles::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'product_id' => $this->faker->randomDigitNotNull,
        'product_attach_id' => $this->faker->randomDigitNotNull,
        'product_attach_price' => $this->faker->randomDigitNotNull,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
