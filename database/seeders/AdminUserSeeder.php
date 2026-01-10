<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'Admin@gmail.com'], // Check if this email exists
            [
                'name' => 'Super Admin',
                'password' => Hash::make('password'), // Always hash the password
                'role_id' => 1, // Assigns the Super Admin role (ensure Role ID 1 exists)
                'email_verified_at' => now(), // Auto-verify the email
            ]
        );
    }
}