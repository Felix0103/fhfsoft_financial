<?php

namespace Database\Seeders;

use App\Models\BillingCycle;
use Illuminate\Database\Seeder;

class BillingCycleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        BillingCycle::create(['description' => 'Diario', 'type' => 1, 'value' => 1]);
        BillingCycle::create(['description' => 'Interdiario', 'type' => 1, 'value' => 2]);
        BillingCycle::create(['description' => 'Semanal', 'type' => 1, 'value' => 7]);
        BillingCycle::create(['description' => 'Quincenal', 'type' => 2, 'value' => 1]);
        BillingCycle::create(['description' => 'Mensual', 'type' => 3, 'value' => 1]);
    }
}
