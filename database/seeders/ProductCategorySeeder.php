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
                'is_active' => true,
            ],
            [
                'name' => 'Ilmu Data',
                'slug' => 'ilmu-data',
                'description' => 'Kursus analisis data dan machine learning',
                'is_active' => true,
            ],
            [
                'name' => 'Pemasaran',
                'slug' => 'pemasaran',
                'description' => 'Kursus pemasaran digital dan strategi bisnis',
                'is_active' => true,
            ],
            [
                'name' => 'Desain',
                'slug' => 'desain',
                'description' => 'Kursus desain UI/UX dan grafis',
                'is_active' => true,
            ],
            [
                'name' => 'Pengembangan Mobile',
                'slug' => 'pengembangan-mobile',
                'description' => 'Kursus pengembangan aplikasi mobile iOS dan Android',
                'is_active' => true,
            ],
            [
                'name' => 'Keamanan',
                'slug' => 'keamanan',
                'description' => 'Kursus keamanan siber dan etikal hacking',
                'is_active' => true,
            ],
        ];

        foreach ($categories as $category) {
            ProductCategory::create($category);
        }
    }
}
