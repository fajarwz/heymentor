<?php

namespace Database\Seeders;

use App\Models\Mentor;
use App\Models\Title;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MentorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $title = Title::first();

        $user = User::create([
            'name' => 'Ivanna Link',
            'email' => 'ivanna.link@gmail.com',
            'password' => 'password',
            'image' => 'https://images.unsplash.com/photo-1548142813-c348350df52b?q=80&w=2592&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
            'role' => User::ROLE_MENTOR, 
        ]);

        Mentor::insert([
            [
                'user_id' => $user->id,
                'title_id' => $title->id,
                'start_date_experience' => now()->subYear(8),
                'about' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempore laudantium veniam corrupti voluptatibus placeat cumque quidem, modi ducimus quas corporis! Voluptatem, porro atque ullam iusto hic doloremque tenetur numquam amet!<br/>Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempore laudantium veniam corrupti voluptatibus placeat cumque quidem, modi ducimus quas corporis! Voluptatem, porro atque ullam iusto hic doloremque tenetur numquam amet!',
                'price_per_hour' => 29.99,
                'total_sessions' => 193,
            ],
        ]);
    }
}
