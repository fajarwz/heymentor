<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Setting::firstOrCreate([
            'tax_percent' => 11,
            'career_insurance_cost' => 19.99,
            'add_on_tools_cost' => 9.99,
        ]);
    }
}
