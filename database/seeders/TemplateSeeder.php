<?php

namespace Database\Seeders;

use App\Models\Template;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TemplateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=1;$i<=10;$i++)
        {
            Template::create(
                    [
                        'name' => 'template '.$i,
                        'owner_id' => 1,
                        'parent_id' => NULL,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]
             );
        }
    }
}
