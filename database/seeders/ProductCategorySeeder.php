<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProductCategory;

class ProductCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Pengembangan Web',
                'slug' => 'pengembangan-web',
                'description' => 'Kursus pengembangan web dari dasar hingga lanjutan',
                'icon' => 'fas fa-code',
                'color' => '#3B82F6',
                'is_active' => true,
                'sort_order' => 1,
            ],
            [
                'name' => 'Ilmu Data',
                'slug' => 'ilmu-data',
                'description' => 'Kursus analisis data dan machine learning',
                'icon' => 'fas fa-chart-bar',
                'color' => '#10B981',
                'is_active' => true,
                'sort_order' => 2,
            ],
            [
                'name' => 'Pemasaran',
                'slug' => 'pemasaran',
                'description' => 'Kursus pemasaran digital dan strategi bisnis',
                'icon' => 'fas fa-bullhorn',
                'color' => '#F59E0B',
                'is_active' => true,
                'sort_order' => 3,
            ],
            [
                'name' => 'Desain',
                'slug' => 'desain',
                'description' => 'Kursus desain UI/UX dan grafis',
                'icon' => 'fas fa-palette',
                'color' => '#EF4444',
                'is_active' => true,
                'sort_order' => 4,
            ],
            [
                'name' => 'Pengembangan Mobile',
                'slug' => 'pengembangan-mobile',
                'description' => 'Kursus pengembangan aplikasi mobile iOS dan Android',
                'icon' => 'fas fa-mobile-alt',
                'color' => '#8B5CF6',
                'is_active' => true,
                'sort_order' => 5,
            ],
            [
                'name' => 'Keamanan',
                'slug' => 'keamanan',
                'description' => 'Kursus keamanan siber dan etikal hacking',
                'icon' => 'fas fa-shield-alt',
                'color' => '#6B7280',
                'is_active' => true,
                'sort_order' => 6,
            ],
        ];

        foreach ($categories as $category) {
            ProductCategory::create($category);
        }
    }
}
