<?php

namespace Database\Factories;

use App\Models\TopProduct;
use Illuminate\Database\Eloquent\Factories\Factory;

class TopProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = TopProduct::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'product_id' => $this->faker->randomDigitNotNull,
        'type' => $this->faker->word,
        'group_id' => $this->faker->randomDigitNotNull,
        'position' => $this->faker->randomDigitNotNull,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
