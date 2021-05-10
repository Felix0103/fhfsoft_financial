<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Country;
use App\Models\State;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Country::create([
            'name' => 'Republica Dominicana'
        ]);

        State::create([
            'name' => 'Puerto Plata',
            'country_id' => 1
        ]);

        City::create([
            'name' => 'Puerto Plata',
            'state_id' => 1
        ]);
    }
}
