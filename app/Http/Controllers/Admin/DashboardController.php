<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Product;
use App\Models\Bootcamp;
use App\Models\Blog;
use App\Models\Mentor;
use App\Models\Category;
use App\Models\ProductCategory;
use App\Models\BlogTag;

class DashboardController extends Controller
{
    public function index()
    {
        // Get statistics from database
        $stats = [
            [
                'title' => 'Total Admins',
                'value' => User::count(),
                'change' => '+12%',
                'changeType' => 'increase',
                'icon' => 'fas fa-users',
                'color' => 'blue'
            ],
            [
                'title' => 'Total Products',
                'value' => Product::count(),
                'change' => '+8%',
                'changeType' => 'increase',
                'icon' => 'fas fa-book',
                'color' => 'green'
            ],
            [
                'title' => 'Total Bootcamps',
                'value' => Bootcamp::count(),
                'change' => '+15%',
                'changeType' => 'increase',
                'icon' => 'fas fa-campground',
                'color' => 'purple'
            ],
            [
                'title' => 'Total Mentors',
                'value' => Mentor::count(),
                'change' => '+5%',
                'changeType' => 'increase',
                'icon' => 'fas fa-chalkboard-teacher',
                'color' => 'yellow'
            ],
            [
                'title' => 'Total Blogs',
                'value' => Blog::count(),
                'change' => '+20%',
                'changeType' => 'increase',
                'icon' => 'fas fa-blog',
                'color' => 'pink'
            ]
        ];

        // Get chart data
        $monthlyData = $this->getMonthlyData();

        // Get recent items
        $recentProducts = Product::with('productCategory')->latest()->take(5)->get();
        $recentBootcamps = Bootcamp::with('category')->latest()->take(5)->get();
        $recentBlogs = Blog::latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'stats',
            'monthlyData',
            'recentProducts',
            'recentBootcamps',
            'recentBlogs'
        ));
    }

    private function getMonthlyData()
    {
        // Get data for the last 6 months
        $months = [];
        $productData = [];
        $bootcampData = [];
        $userData = [];

        for ($i = 5; $i >= 0; $i--) {
            $month = now()->subMonths($i);
            $monthName = $month->format('M');
            $months[] = $monthName;

            // For demo purposes, we'll use random data
            // In real application, you would query actual monthly data
            $productData[] = rand(10, 50);
            $bootcampData[] = rand(5, 25);
            $userData[] = rand(20, 100);
        }

        return [
            'months' => $months,
            'products' => $productData,
            'bootcamps' => $bootcampData,
            'users' => $userData
        ];
    }
}
