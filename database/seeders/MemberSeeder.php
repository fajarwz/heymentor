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
                'phone_number' => '034893849343',
            ],
            [
                'name' => 'Jerry Frost',
                'email' => 'jerry.frost@test.com',
                'phone_number' => '085495802453',
            ],
            [
                'name' => 'William Jr',
                'email' => 'william.jr@test.com',
                'phone_number' => '085834579454',
            ],
        ];

        foreach ($data as $data) {
            User::create([
                'name' => $data['name'],
                'username' => str($data['name'])->lower()->snake(),
                'phone_number' => $data['phone_number'],
                'email' => $data['email'],
                'password' => 'password',
                'image' => env('AVATAR_URL').$data['name'],
                'role' => User::ROLE_MEMBER, 
            ]);
        }
    }
}
