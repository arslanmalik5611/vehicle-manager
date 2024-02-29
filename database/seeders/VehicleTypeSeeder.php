<?php

namespace Database\Seeders;

use App\Models\VehicleType;
use Illuminate\Database\Seeder;

class VehicleTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $VehicleType = array(
            array('name' => 'car'),
            array('name' => 'tractor')
        );

        VehicleType::insert($VehicleType);
    }
}
