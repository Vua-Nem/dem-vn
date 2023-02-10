<?php

namespace Database\Factories;

use App\Models\WishList;
use Illuminate\Database\Eloquent\Factories\Factory;

class WishListFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = WishList::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'phone_number' => $this->faker->word,
        'email' => $this->faker->word,
        'full_name' => $this->faker->word,
        'province_id' => $this->faker->randomDigitNotNull,
        'district_id' => $this->faker->randomDigitNotNull,
        'address' => $this->faker->word,
        'oder_item' => $this->faker->text,
        'status_telegram' => $this->faker->word,
        'time_send_telegram' => $this->faker->randomDigitNotNull,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
