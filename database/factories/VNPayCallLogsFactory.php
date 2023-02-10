<?php

namespace Database\Factories;

use App\Models\VNPayCallLogs;
use Illuminate\Database\Eloquent\Factories\Factory;

class VNPayCallLogsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = VNPayCallLogs::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'order_id' => $this->faker->randomDigitNotNull,
        'transaction_id' => $this->faker->randomDigitNotNull,
        'bank_code' => $this->faker->word,
        'data' => $this->faker->text,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
