<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        DB::table('users')->insert(
            [
                'role_id' => 1,
                'first_name' => 'Admin',
                'last_name' => 'admin',
                'slug' => 'admin',
                'email' => 'admin@gmail.com',
                'created_by' => 1,
                'gender' => 'Male',
                'phone' => '1234567891',
                'password' => Hash::make('admin@12'),
                'image' => 'null',
                'email_status' => 1,
                'status' => 1 ,
                'created_at' => now()
            ]
        );
    }
}
