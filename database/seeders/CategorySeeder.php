<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Web Development',
                'slug' => 'web-development',
                'description' => 'Learn modern web development technologies including HTML, CSS, JavaScript, and popular frameworks like React and Vue.js.',
                'is_active' => true,
            ],
            [
                'name' => 'Data Science',
                'slug' => 'data-science',
                'description' => 'Master data analysis, machine learning, and data visualization techniques using Python, R, and specialized tools.',
                'is_active' => true,
            ],
            [
                'name' => 'Design',
                'slug' => 'design',
                'description' => 'Develop your creative skills in UI/UX design, graphic design, and digital product design.',
                'is_active' => true,
            ],
            [
                'name' => 'Marketing',
                'slug' => 'marketing',
                'description' => 'Learn digital marketing strategies, social media management, and content marketing to grow your business.',
                'is_active' => true,
            ],
            [
                'name' => 'Mobile Development',
                'slug' => 'mobile-development',
                'description' => 'Build native mobile applications for iOS and Android using modern frameworks and best practices.',
                'is_active' => true,
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
