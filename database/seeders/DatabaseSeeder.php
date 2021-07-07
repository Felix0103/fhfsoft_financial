<?php

namespace Database\Seeders;

use App\Models\BillingCycle;
use App\Models\Client;
use App\Models\Partner;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(RoleSeeder::class);
        $this->call(IdentificationTypeSeeder::class);

        $this->call(CountrySeeder::class);
        $this->call(BillingCycleSeeder::class);
        $this->call(LoanTypeSeeder::class);
        // Partner::factory(10)->create();
        // Client::factory(50)->create();

        User::create([
            'name' => 'Felix Hernandez',
            'email' => 'admin@admin.com',
            'email_verified_at' => now(),
            'password' => bcrypt('12345678'), // password
            'remember_token' => Str::random(10),
        ])->assignRole('Admin');
        /// User::factory(20)->create();

    }
}
