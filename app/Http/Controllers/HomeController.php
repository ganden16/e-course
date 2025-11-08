<?php

namespace App\Http\Controllers;

use App\Models\Bootcamp;
use App\Models\Product;
use App\Models\Blog;
use App\Models\Category;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display the home page with dynamic data.
     */
    public function index(Request $request)
    {
        $locale = app()->getLocale();

        // Load language file for landing page
        $translations = include lang_path("{$locale}/landingPage.php");
        $site = $translations['site'];
        $hero = $translations['hero'];
        $stats = $translations['stats'];
        $features = $translations['features'];
        $featured_courses = $translations['featured_courses'];
        $upcoming_bootcamps = $translations['upcoming_bootcamps'];
        $latest_blog = $translations['latest_blog'];
        $testimonials = $translations['testimonials'];
        $cta = $translations['cta'];

        // Get data from language files for static sections
        $statsData = $stats['data'];
        $featuresData = $features['data'];
        $testimonialsData = $testimonials['data'];

        // Get dynamic data from database
        $products = Product::with('productCategory')
            ->where('is_active', true)
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get();

        $bootcamps = Bootcamp::with(['category', 'mentors'])
            ->where('is_active', true)
            ->orderBy('created_at', 'desc')
            ->take(2)
            ->get();

        $blogs = Blog::with(['tags'])
            ->active()
            ->latest('published_at')
            ->take(3)
            ->get();

        // Build URLs with current locale
        $baseUrl = '/' . $locale;

        return view('welcome', compact(
            'site',
            'hero',
            'stats',
            'features',
            'featured_courses',
            'upcoming_bootcamps',
            'latest_blog',
            'testimonials',
            'cta',
            'statsData',
            'featuresData',
            'testimonialsData',
            'products',
            'bootcamps',
            'blogs',
            'baseUrl'
        ));
    }
}
