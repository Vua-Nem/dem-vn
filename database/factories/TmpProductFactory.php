<?php

namespace Database\Factories;

use App\Models\TmpProduct;
use Illuminate\Database\Eloquent\Factories\Factory;

class TmpProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = TmpProduct::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'product_id' => $this->faker->randomDigitNotNull,
        'sku' => $this->faker->word,
        'content' => $this->faker->text,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
