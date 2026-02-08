<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Admin',
                'email' => 'mushegh.avetisyan.web@gmail.com',
                'password' => Hash::make('0199'), // Replace with a secure password
                'is_active' => false,
                'role' => 1, // Use roles if applicable
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ];

        DB::table('users')->insert($users);
        User::factory()
            ->count(10)
            ->state([
                'role' => 0, // Default user role
                'is_active' => false, // Set all users as active
            ])
            ->create();
    }
}
