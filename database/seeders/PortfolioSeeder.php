<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Portfolio;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PortfolioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $mentor = User::where('role', User::ROLE_MENTOR)->first();

        Portfolio::insert([
            [
                'user_id' => $mentor->id,
                'link' => 'https://cdn.dribbble.com/userupload/10670066/file/original-d352b1cd5d172f399da589d5885d34c8.png?resize=1504x1128',
            ],
            [
                'user_id' => $mentor->id,
                'link' => 'https://cdn.dribbble.com/userupload/10670066/file/original-d352b1cd5d172f399da589d5885d34c8.png?resize=1504x1128',
            ],
            [
                'user_id' => $mentor->id,
                'link' => 'https://cdn.dribbble.com/userupload/10670066/file/original-d352b1cd5d172f399da589d5885d34c8.png?resize=1504x1128',
            ],
            [
                'user_id' => $mentor->id,
                'link' => 'https://cdn.dribbble.com/userupload/10670066/file/original-d352b1cd5d172f399da589d5885d34c8.png?resize=1504x1128',
            ],
        ]);
    }
}
