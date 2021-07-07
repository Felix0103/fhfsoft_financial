<?php

namespace Database\Seeders;

use App\Models\LoanType;
use Illuminate\Database\Seeder;

class LoanTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        LoanType::create(['description' => 'Prestamo']);
        LoanType::create(['description' => 'San']);
        LoanType::create(['description' => 'Redito']);
    }
}
