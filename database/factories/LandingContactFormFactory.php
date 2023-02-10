<?php

namespace Database\Factories;

use App\Models\LandingContactForm;
use Illuminate\Database\Eloquent\Factories\Factory;

class LandingContactFormFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = LandingContactForm::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'full_name' => $this->faker->word,
        'phone' => $this->faker->word,
        'email' => $this->faker->word,
        'source' => $this->faker->word,
        'note' => $this->faker->word,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
