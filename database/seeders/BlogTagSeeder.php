<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\BlogTag;

class BlogTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tags = [
            ['name' => 'Web Development', 'color' => '#3B82F6'],
            ['name' => 'Trends', 'color' => '#10B981'],
            ['name' => '2024', 'color' => '#F59E0B'],
            ['name' => 'Technology', 'color' => '#8B5CF6'],
            ['name' => 'Machine Learning', 'color' => '#EF4444'],
            ['name' => 'Data Science', 'color' => '#06B6D4'],
            ['name' => 'Beginner', 'color' => '#84CC16'],
            ['name' => 'AI', 'color' => '#F97316'],
            ['name' => 'Digital Marketing', 'color' => '#EC4899'],
            ['name' => 'Small Business', 'color' => '#6366F1'],
            ['name' => 'Strategy', 'color' => '#14B8A6'],
            ['name' => 'SEO', 'color' => '#A855F7'],
            ['name' => 'UX Design', 'color' => '#0EA5E9'],
            ['name' => 'Psychology', 'color' => '#D946EF'],
            ['name' => 'User Experience', 'color' => '#F43F5E'],
            ['name' => 'Design Principles', 'color' => '#22C55E'],
            ['name' => 'Mobile Development', 'color' => '#3B82F6'],
            ['name' => 'Responsive Design', 'color' => '#10B981'],
            ['name' => 'Best Practices', 'color' => '#F59E0B'],
            ['name' => 'Cybersecurity', 'color' => '#EF4444'],
            ['name' => 'Remote Work', 'color' => '#06B6D4'],
            ['name' => 'Data Protection', 'color' => '#84CC16'],
            ['name' => 'Security Best Practices', 'color' => '#F97316'],
        ];

        foreach ($tags as $tag) {
            BlogTag::create($tag);
        }
    }
}
