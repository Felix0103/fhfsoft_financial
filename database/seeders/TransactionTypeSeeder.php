<?php

namespace Database\Seeders;

use App\Models\TransactionType;
use Illuminate\Database\Seeder;

class TransactionTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TransactionType::create(['description'=> 'Credito', 'type' => 1 , 'active' =>1]);
        TransactionType::create(['description'=> 'Debito', 'type' => 2 , 'active' =>1]);
        TransactionType::create(['description'=> 'Interes', 'type' => 2 , 'active' =>1]);
        TransactionType::create(['description'=> 'Pago Capital', 'type' => 1 , 'active' =>1]);
        TransactionType::create(['description'=> 'Pago Interes', 'type' => 1 , 'active' =>1]);

    }
}
