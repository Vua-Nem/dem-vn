<?php

namespace Database\Factories;

use App\Models\Voucher;
use Illuminate\Database\Eloquent\Factories\Factory;

class VoucherFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Voucher::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->word,
        'voucher_type' => $this->faker->word,
        'discount_type' => $this->faker->word,
        'discount_value' => $this->faker->randomDigitNotNull,
        'min_order_amount' => $this->faker->randomDigitNotNull,
        'min_quantity_item' => $this->faker->randomDigitNotNull,
        'start_date' => $this->faker->randomDigitNotNull,
        'end_date' => $this->faker->randomDigitNotNull,
        'status' => $this->faker->randomDigitNotNull,
        'created_by' => $this->faker->randomDigitNotNull,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
