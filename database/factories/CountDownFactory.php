<?php

namespace Database\Factories;

use App\Models\CountDown;
use Illuminate\Database\Eloquent\Factories\Factory;

class CountDownFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CountDown::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->word,
        'name' => $this->faker->word,
        'start_date' => $this->faker->randomDigitNotNull,
        'end_date' => $this->faker->randomDigitNotNull,
        'status' => $this->faker->randomDigitNotNull,
        'created_by' => $this->faker->randomDigitNotNull,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
