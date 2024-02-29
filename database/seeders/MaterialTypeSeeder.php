<?php

namespace Database\Seeders;

use App\Models\MaterialType;
use Illuminate\Database\Seeder;

class MaterialTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $MaterialType = array(
            array('name' => 'Part'),
            array('name' => 'Material')
        );

        MaterialType::insert($MaterialType);
    }
}
