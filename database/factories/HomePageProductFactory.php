<?php

namespace Database\Factories;

use App\Models\HomePageProduct;
use Illuminate\Database\Eloquent\Factories\Factory;

class HomePageProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = HomePageProduct::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'product_id' => $this->faker->randomDigitNotNull,
        'position' => $this->faker->randomDigitNotNull,
        'group' => $this->faker->randomDigitNotNull,
        'status' => $this->faker->word,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
