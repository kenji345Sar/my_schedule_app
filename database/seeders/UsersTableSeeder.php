<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'User1',
                'email' => 'user1@example.com',
                'password' => Hash::make('password123')
            ],
            [
                'name' => 'User2',
                'email' => 'user2@example.com',
                'password' => Hash::make('password123')
            ],
            [
                'name' => 'User3',
                'email' => 'user3@example.com',
                'password' => Hash::make('password123')
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
