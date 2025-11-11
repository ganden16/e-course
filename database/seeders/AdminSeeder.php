<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 20; $i++) {
            $name = 'Admin User ' . $i;
            $username = 'admin' . $i;
            $email = 'admin' . $i . '@healthcare.com';

            // Use local image for each admin
            $imageUrl = env('APP_URL').'/storage/users/' . (($i % 13) + 1) . '.jpg';

            \App\Models\User::create([
                'name' => $name,
                'username' => $username,
                'email' => $email,
                'password' => Hash::make('admin123'),
                'image' => $imageUrl,
            ]);
        }
    }

    /**
     * Get random color for avatar
     */
    private function getRandomColor($index): string
    {
        $colors = [
            '7F9CF5', 'F59E0B', '10B981', '3B82F6', '2E7D32', '6366F1',
            '4CAF50', '8BC34A', '00BCD4', '2196F3', '9C27B0', 'FB8C00',
            'FF6B6B', 'FF9800', 'FFC107', '795548', '607D8B', 'E91E63', '9A8483'
        ];

        return $colors[($index - 1) % count($colors)];
    }
}
