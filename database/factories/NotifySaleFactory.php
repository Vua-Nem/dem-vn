<?php

namespace Database\Factories;

use App\Models\NotifySale;
use Illuminate\Database\Eloquent\Factories\Factory;

class NotifySaleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = NotifySale::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'product_id' => $this->faker->randomDigitNotNull,
        'notify_title' => $this->faker->word,
        'notify_des' => $this->faker->text,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
