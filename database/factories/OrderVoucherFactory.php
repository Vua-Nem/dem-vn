<?php

namespace Database\Factories;

use App\Models\OrderVoucher;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderVoucherFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = OrderVoucher::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'order_id' => $this->faker->randomDigitNotNull,
        'voucher_id' => $this->faker->randomDigitNotNull,
        'voucher_discount_type' => $this->faker->randomDigitNotNull,
        'voucher_discount_value' => $this->faker->randomDigitNotNull,
        'voucher_created_by' => $this->faker->randomDigitNotNull,
        'voucher_start_date' => $this->faker->randomDigitNotNull,
        'voucher_end_date' => $this->faker->randomDigitNotNull,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
