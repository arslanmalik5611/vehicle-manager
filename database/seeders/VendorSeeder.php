<?php

namespace Database\Seeders;

use App\Models\Vendor;
use Illuminate\Database\Seeder;

class VendorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $Vender = array(
            array('name' => 'MrLeven'),
            array('name' => 'Arslan'),
        );

        Vendor::insert($Vender);
    }
}
