<?php

namespace Database\Seeders;

use App\Models\IdentificationType;
use Illuminate\Database\Seeder;

class IdentificationTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        IdentificationType::create(['description' => 'Cedula', 'active'=> 1]);
        IdentificationType::create(['description' => 'Pasaporte', 'active'=> 1]);
        IdentificationType::create(['description' => 'Registro Nacional de Contribuyentes (RNC)', 'active'=> 1]);
    }
}
