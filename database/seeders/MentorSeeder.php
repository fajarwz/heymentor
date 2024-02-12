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
        $titles = Title::pluck('id')->toArray();

        $data = [
            [
                'name' => 'Ivanna Link',
                'email' => 'ivanna.link@gmail.com',
                'image' => 'https://images.unsplash.com/photo-1548142813-c348350df52b?q=80&w=2592&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
                'start_date_experience' => now()->subYear(8),
                'price_per_hour' => 29.99,
                'total_sessions' => 193,
            ],
            [
                'name' => 'John Doe',
                'email' => 'john.doe@gmail.com',
                'image' => 'https://images.pexels.com/photos/614810/pexels-photo-614810.jpeg',
                'start_date_experience' => now()->subYear(6),
                'price_per_hour' => 24.99,
                'total_sessions' => 176,
            ],
            [
                'name' => 'Johnny Dae',
                'email' => 'johnny.dae@gmail.com',
                'image' => 'https://images.pexels.com/photos/1222271/pexels-photo-1222271.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1',
                'start_date_experience' => now()->subYear(11),
                'price_per_hour' => 36.99,
                'total_sessions' => 214,
            ],
        ];

        foreach ($data as $data) {
            $user = User::create([
                'name' => $data['name'],
                'username' => str($data['name'])->lower()->snake(),
                'email' => $data['email'],
                'password' => 'password',
                'image' => $data['image'],
                'role' => User::ROLE_MENTOR, 
            ]);
    
            Mentor::insert([
                [
                    'user_id' => $user->id,
                    'title_id' => fake()->numberBetween(min($titles), max($titles)),
                    'start_date_experience' => $data['start_date_experience'],
                    'about' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempore laudantium veniam corrupti voluptatibus placeat cumque quidem, modi ducimus quas corporis! Voluptatem, porro atque ullam iusto hic doloremque tenetur numquam amet!<br/>Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempore laudantium veniam corrupti voluptatibus placeat cumque quidem, modi ducimus quas corporis! Voluptatem, porro atque ullam iusto hic doloremque tenetur numquam amet!',
                    'price_per_hour' => $data['price_per_hour'],
                    'total_sessions' => $data['total_sessions'],
                ],
            ]);
        }
    }
}
