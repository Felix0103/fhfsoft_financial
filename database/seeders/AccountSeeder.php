<?php

namespace Database\Seeders;

use App\Models\Account;
use App\Models\SubAccount;
use Illuminate\Database\Seeder;

class AccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        //Activos
        $activo = Account::create(['description'=>'Caja y Bancos', 'code'=>'11-10']);
                SubAccount::create(['description' => 'Caja Chica' , 'account_id'=> $activo->id, 'code' => '11-10-1']);
                SubAccount::create(['description' => 'Banco Popular' , 'account_id'=> $activo->id, 'code' => '11-10-2']);
                SubAccount::create(['description' => 'Banco de Reservas' , 'account_id'=> $activo->id, 'code' => '11-10-3']);
                SubAccount::create(['description' => 'Scotia Bank' , 'account_id'=> $activo->id, 'code' => '11-10-4']);


        $cxc = Account::create(['description'=>'Cuenta por Cobrar', 'code'=>'11-20']);



    }
}
