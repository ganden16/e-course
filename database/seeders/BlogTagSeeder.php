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
            ['name' => 'Web Development'],
            ['name' => 'Trends'],
            ['name' => '2024'],
            ['name' => 'Technology'],
            ['name' => 'Machine Learning'],
            ['name' => 'Data Science'],
            ['name' => 'Beginner'],
            ['name' => 'AI'],
            ['name' => 'Digital Marketing'],
            ['name' => 'Small Business'],
            ['name' => 'Strategy'],
            ['name' => 'SEO'],
            ['name' => 'UX Design'],
            ['name' => 'Psychology'],
            ['name' => 'User Experience'],
            ['name' => 'Design Principles'],
            ['name' => 'Mobile Development'],
            ['name' => 'Responsive Design'],
            ['name' => 'Best Practices'],
            ['name' => 'Cybersecurity'],
            ['name' => 'Remote Work'],
            ['name' => 'Data Protection'],
            ['name' => 'Security Best Practices'],
        ];

        foreach ($tags as $tag) {
            BlogTag::create($tag);
        }
    }
}
