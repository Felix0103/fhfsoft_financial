<?php

namespace Database\Factories;

use App\Models\Partner;
use Illuminate\Database\Eloquent\Factories\Factory;

class PartnerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Partner::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'first_name' => $this->faker->firstName($gender = 'male'|'female'),
            'last_name' => $this->faker->lastName,
            'identification_type_id' => $this->faker->randomElement([1,2,3]),
            'identification' => $this->faker->unique()->numerify('###########'),
            'percentage_earn' => $this->faker->randomNumber(2),
            'initial_investment' => $this->faker->randomNumber(5),
            'active'=>1
        ];
    }
}
