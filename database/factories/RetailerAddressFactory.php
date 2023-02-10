<?php

namespace Database\Factories;

use App\Models\RetailerAddress;
use Illuminate\Database\Eloquent\Factories\Factory;

class RetailerAddressFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = RetailerAddress::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'entity_id' => $this->faker->randomDigitNotNull,
        'address' => $this->faker->word,
        'slug' => $this->faker->word,
        'name' => $this->faker->word,
        'postcode' => $this->faker->word,
        'latitude' => $this->faker->word,
        'longitude' => $this->faker->word,
        'phone_store' => $this->faker->word,
        'extension_number' => $this->faker->word,
        'province_id' => $this->faker->randomDigitNotNull,
        'district_id' => $this->faker->randomDigitNotNull,
        'status' => $this->faker->word,
        'opening_time' => $this->faker->word,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
