<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'name' => 'Admin',
                'email' => 'admin@test.com',
            ],
        ];

        foreach ($data as $data) {
            User::create([
                'name' => $data['name'],
                'username' => str($data['name'])->lower()->snake(),
                'email' => $data['email'],
                'password' => 'password',
                'image' => env('AVATAR_URL').$data['name'],
                'role' => UserRole::ROLE_ADMIN, 
            ]);
        }
    }
}
