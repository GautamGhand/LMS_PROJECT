<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('statuses')->insert(
            [
                [
                    'name' => 'Published',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'name' => 'Archived',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'name' => 'Draft',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]

            ]
        );
            
    }
}
