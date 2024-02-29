<?php

namespace Database\Seeders;

use App\Models\FeeStructure;
use Illuminate\Database\Seeder;

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
        $this->call(CitySeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(DriverSeeder::class);
        $this->call(DepartmentSeeder::class);
        $this->call(VehicleTypeSeeder::class);
        $this->call(VendorSeeder::class);
        $this->call(MaterialTypeSeeder::class);

        
    }
}
