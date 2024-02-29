<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $Departments = array(
            array('name' => 'Administration'),
            array('name' => 'Engineering'),
            array('name' => 'Facilities'),
            array('name' => 'Production'),
        );
        Department::insert($Departments);
    }
}
