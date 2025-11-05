<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin User',
            'username' => 'admin',
            'email' => 'admin@healthcare.com',
            'password' => Hash::make('admin123'),
            'image' => 'https://ui-avatars.com/api/?name=Admin+User&color=7F9CF5&background=EBF4FF&size=200',
        ]);

        User::create([
            'name' => 'Test User',
            'username' => 'user',
            'email' => 'user@healthcare.com',
            'password' => Hash::make('user123'),
            'image' => 'https://ui-avatars.com/api/?name=Test+User&color=7F9CF5&background=EBF4FF&size=200',
        ]);
    }
}
