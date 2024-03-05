<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $Setting = array(
            'home_image' => 'http://localhost:8000/uploads/vehicle-assets/1.jpg',
            'home_title' => 'Vehicle System By Arslan',
            'home_description' => 'Vehicle System By Arslan Description'
        );

        Setting::insert($Setting);
    }
}
