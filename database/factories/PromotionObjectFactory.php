<?php

namespace Database\Factories;

use App\Models\PromotionObject;
use Illuminate\Database\Eloquent\Factories\Factory;

class PromotionObjectFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PromotionObject::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'promotion_id' => $this->faker->randomDigitNotNull,
        'object_id' => $this->faker->randomDigitNotNull,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
