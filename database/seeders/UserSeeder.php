<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // User::create([
        //     'first_name' => 'John',
        //     'last_name' => 'Doe',
        //     'role_id' => '1',
        //     'phone' => '1234',
        //     'address' => 'Doe',
        //     'cnic' => '123234',
        //     'picture' => 'Doe',
        //     'gender' => 'Male',
        //     'father_name' => 'Doe',
        //     'email' => 'admin@web.com',
        //     'password' => Hash::make('123456')
        // ]);
        $users = array(
            array('id' => '1', 'role_id' => '1', 'first_name' => 'Admin', 'last_name' => 'Doe', 'father_name' => 'Doe', 'email' => 'admin@web.com', 'phone' => '1234', 'domicile' => NULL, 'password' => '$2y$10$slnhYc5Ohi51HNd1YXYQH.ibMWmfGyL2XhFOcb/ICNpQVsDYLVx5.', 'cnic' => '123234', 'gender' => 'Male', 'picture' => 'Doe', 'dob' => NULL, 'address' => 'Doe', 'city_id' => NULL, 'email_verified_at' => NULL, 'remember_token' => NULL, 'deleted_at' => NULL, 'created_at' => '2022-08-10 14:40:27', 'updated_at' => '2022-08-10 14:40:27'),

            array('id' => '2', 'role_id' => '6', 'first_name' => 'Arslan', 'last_name' => NULL, 'father_name' => 'arslanFather', 'email' => 'arslan@yahoo.com', 'phone' => '+923045610582', 'domicile' => '12', 'password' => NULL, 'cnic' => '33100-0000000-1', 'gender' => 'male', 'picture' => '3U8hdvoDe7.png', 'dob' => '2022-08-11', 'address' => 'P427 Gm Abad FSD', 'city_id' => '3', 'email_verified_at' => NULL, 'remember_token' => NULL, 'deleted_at' => NULL, 'created_at' => '2022-08-11 06:20:42', 'updated_at' => '2022-08-11 06:20:42'),

            array('id' => '3', 'role_id' => '7', 'first_name' => 'arslanFather', 'last_name' => NULL, 'father_name' => NULL, 'email' => 'arslanFather@yahoo.com', 'phone' => '+923045610582', 'domicile' => NULL, 'password' => NULL, 'cnic' => '33100-1234567-0', 'gender' => NULL, 'picture' => NULL, 'dob' => NULL, 'address' => 'P427 Gm Abad FSD', 'city_id' => NULL, 'email_verified_at' => NULL, 'remember_token' => NULL, 'deleted_at' => NULL, 'created_at' => '2022-08-11 06:20:42', 'updated_at' => '2022-08-11 06:20:42'),

            array('id' => '4', 'role_id' => '2', 'first_name' => 'Campus Manager', 'last_name' => 'Doe', 'father_name' => 'Doe', 'email' => 'campusmanager@web.com', 'phone' => '1234', 'domicile' => NULL, 'password' => '$2y$10$slnhYc5Ohi51HNd1YXYQH.ibMWmfGyL2XhFOcb/ICNpQVsDYLVx5.', 'cnic' => '123234', 'gender' => 'Male', 'picture' => 'Doe', 'dob' => NULL, 'address' => 'Doe', 'city_id' => NULL, 'email_verified_at' => NULL, 'remember_token' => NULL, 'deleted_at' => NULL, 'created_at' => '2022-08-10 14:40:27', 'updated_at' => '2022-08-10 14:40:27'),

            array('id' => '5', 'role_id' => '3', 'first_name' => 'Staff', 'last_name' => 'Doe', 'father_name' => 'Doe', 'email' => 'staff@web.com', 'phone' => '1234', 'domicile' => NULL, 'password' => '$2y$10$slnhYc5Ohi51HNd1YXYQH.ibMWmfGyL2XhFOcb/ICNpQVsDYLVx5.', 'cnic' => '123234', 'gender' => 'Male', 'picture' => 'Doe', 'dob' => NULL, 'address' => 'Doe', 'city_id' => NULL, 'email_verified_at' => NULL, 'remember_token' => NULL, 'deleted_at' => NULL, 'created_at' => '2022-08-10 14:40:27', 'updated_at' => '2022-08-10 14:40:27'),

            array('id' => '6', 'role_id' => '4', 'first_name' => 'Teacher', 'last_name' => 'Doe', 'father_name' => 'Doe', 'email' => 'teacher@web.com', 'phone' => '1234', 'domicile' => NULL, 'password' => '$2y$10$slnhYc5Ohi51HNd1YXYQH.ibMWmfGyL2XhFOcb/ICNpQVsDYLVx5.', 'cnic' => '123234', 'gender' => 'Male', 'picture' => 'Doe', 'dob' => NULL, 'address' => 'Doe', 'city_id' => NULL, 'email_verified_at' => NULL, 'remember_token' => NULL, 'deleted_at' => NULL, 'created_at' => '2022-08-10 14:40:27', 'updated_at' => '2022-08-10 14:40:27'),

            array('id' => '7', 'role_id' => '5', 'first_name' => 'Accountant', 'last_name' => 'Doe', 'father_name' => 'Doe', 'email' => 'accountant@web.com', 'phone' => '1234', 'domicile' => NULL, 'password' => '$2y$10$slnhYc5Ohi51HNd1YXYQH.ibMWmfGyL2XhFOcb/ICNpQVsDYLVx5.', 'cnic' => '123234', 'gender' => 'Male', 'picture' => 'Doe', 'dob' => NULL, 'address' => 'Doe', 'city_id' => NULL, 'email_verified_at' => NULL, 'remember_token' => NULL, 'deleted_at' => NULL, 'created_at' => '2022-08-10 14:40:27', 'updated_at' => '2022-08-10 14:40:27'),
        );
        User::insert($users);
    }
}
