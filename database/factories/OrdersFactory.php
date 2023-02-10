<?php

namespace Database\Factories;

use App\Models\Orders;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrdersFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Orders::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => $this->faker->randomDigitNotNull,
        'user_name' => $this->faker->word,
        'phone_number' => $this->faker->word,
        'province_id' => $this->faker->randomDigitNotNull,
        'district_id' => $this->faker->randomDigitNotNull,
        'address' => $this->faker->word,
        'description' => $this->faker->word,
        'amount' => $this->faker->randomDigitNotNull,
        'real_amount' => $this->faker->randomDigitNotNull,
        'created_by' => $this->faker->randomDigitNotNull,
        'status' => $this->faker->word,
        'payment_method' => $this->faker->word,
        'payment_status' => $this->faker->word,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
