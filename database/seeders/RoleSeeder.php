<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        DB::table('roles')->insert(
            [
                [
                    'name' => 'Admin',
                    'slug' => 'admin',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'name' => 'Sub-Admin',
                    'slug' => 'sub-admin',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'name' => 'Trainer',
                    'slug' => 'trainer',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'name' => 'Employee',
                    'slug' => 'employee',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            ]
        );
    }
}
