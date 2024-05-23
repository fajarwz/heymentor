<?php

namespace Database\Seeders;

use App\Models\Mentor;
use App\Models\Title;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'name' => 'Fajar Z',
                'email' => 'fajar.z@test.com',
            ],
            [
                'name' => 'Jerry Frost',
                'email' => 'jerry.frost@test.com',
            ],
            [
                'name' => 'William Jr',
                'email' => 'william.jr@test.com',
            ],
        ];

        foreach ($data as $data) {
            User::create([
                'name' => $data['name'],
                'username' => str($data['name'])->lower()->snake(),
                'email' => $data['email'],
                'password' => 'password',
                'image' => env('AVATAR_URL').$data['name'],
                'role' => User::ROLE_MEMBER, 
            ]);
        }
    }
}
