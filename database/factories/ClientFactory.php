<?php

namespace Database\Factories;

use App\Models\Client;
use App\Models\Partner;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClientFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Client::class;

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
            'identification_type_id' => $this->faker->randomElement([1, 2, 3]),
            'identification' => $this->faker->unique()->numerify('###########'),
            'credit_limit' => $this->faker->randomNumber(5),
            'active' => 1,
            'partner_id' => Partner::all()->random()->id,
        ];
    }
}
