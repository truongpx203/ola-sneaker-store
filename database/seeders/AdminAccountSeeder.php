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
            'password' => Hash::make('admin001'),
            'phone_number' => '0328902188',
            'role' => 'admin',
            'status' => 'active',
        ]);
    }
}
