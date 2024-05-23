<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TitleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Title::insert([
            [
                'slug' => 'designer',
                'name' => 'Designer',
            ],
            [
                'slug' => 'programmer',
                'name' => 'Programmer',
            ],
            [
                'slug' => 'copywriter',
                'name' => 'Copywriter',
            ],
            [
                'slug' => 'digital-marketing',
                'name' => 'Digital Marketing',
            ],
        ]);
    }
}
