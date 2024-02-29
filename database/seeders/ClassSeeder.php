<?php

namespace Database\Seeders;

use App\Models\SchoolClass;
use Illuminate\Database\Seeder;

class ClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $Class = array(
            array('name' => 'Play Group', 'short_name' => 'pg', 'level' => 1),
            array('name' => 'Nursery', 'short_name' => 'nursery', 'level' => 1),
            array('name' => 'One Class', 'short_name' => 'one', 'level' => 1),
            array('name' => 'Two Class', 'short_name' => 'two', 'level' => 2),
            array('name' => 'Three', 'short_name' => 'three', 'level' => 3),
            array('name' => 'Four', 'short_name' => 'four', 'level' => 4),
            array('name' => 'Five', 'short_name' => 'five', 'level' => 5),
        );

        SchoolClass::insert($Class);
    }
}
