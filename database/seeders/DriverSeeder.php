<?php

namespace Database\Seeders;

use App\Models\Driver;
use Illuminate\Database\Seeder;

class DriverSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $Drivers = array(
            array('name' => 'Driver1'),
            array('name' => 'Driver2'),
            array('name' => 'Driver3'),
        );

        Driver::insert($Drivers);
    }
}
