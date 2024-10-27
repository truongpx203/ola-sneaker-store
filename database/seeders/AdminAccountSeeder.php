<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminAccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'full_name' => 'Admin DZ',
            'email' => 'admin@gmail.com',
            'email_verified_at' => now(),
            'email_verification_sent_at' => now(),
            'password' => Hash::make('12345678'),
            'phone_number' => '0328902188',
            'role' => 'admin',
            'status' => 'active',
        ]);
    }
}
