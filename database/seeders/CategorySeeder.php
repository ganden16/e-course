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
                'icon' => 'fas fa-code',
                'color' => '#3B82F6',
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'name' => 'Data Science',
                'slug' => 'data-science',
                'description' => 'Master data analysis, machine learning, and data visualization techniques using Python, R, and specialized tools.',
                'icon' => 'fas fa-chart-bar',
                'color' => '#10B981',
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'name' => 'Design',
                'slug' => 'design',
                'description' => 'Develop your creative skills in UI/UX design, graphic design, and digital product design.',
                'icon' => 'fas fa-palette',
                'color' => '#F59E0B',
                'sort_order' => 3,
                'is_active' => true,
            ],
            [
                'name' => 'Marketing',
                'slug' => 'marketing',
                'description' => 'Learn digital marketing strategies, social media management, and content marketing to grow your business.',
                'icon' => 'fas fa-bullhorn',
                'color' => '#EF4444',
                'sort_order' => 4,
                'is_active' => true,
            ],
            [
                'name' => 'Mobile Development',
                'slug' => 'mobile-development',
                'description' => 'Build native mobile applications for iOS and Android using modern frameworks and best practices.',
                'icon' => 'fas fa-mobile-alt',
                'color' => '#8B5CF6',
                'sort_order' => 5,
                'is_active' => true,
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
