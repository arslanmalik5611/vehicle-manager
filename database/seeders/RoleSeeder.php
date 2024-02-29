<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\RoleModel;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $Roles = array(
            array('name' => 'Admin', 'code' => 'admin'),
            array('name' => 'Campus Manager', 'code' => 'campus_manager'),
            array('name' => 'Staff', 'code' => 'staff'),
            array('name' => 'Teacher', 'code' => 'teacher'),
            array('name' => 'Accountant', 'code' => 'accountant'),
            array('name' => 'Student', 'code' => 'student'),
            array('name' => 'Parent', 'code' => 'parent'),
            array('name' => 'Guardian', 'code' => 'guardian'),
            array('name' => 'Brother', 'code' => 'brother'),
            array('name' => 'Sister', 'code' => 'sister'),
        );

        Role::insert($Roles);

    }
}
