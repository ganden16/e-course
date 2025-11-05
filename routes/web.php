<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\BootcampController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\AuthController;

// Language switch route
Route::get('/lang/{locale}', [LanguageController::class, 'switch'])->name('language.switch');

// Group routes with language prefix
Route::group(['prefix' => '{locale}', 'where' => ['locale' => 'id|en']], function () {
    Route::get('/', function () {
        return view('welcome');
    })->name('home');

    Route::get('/about-us', function () {
        return view('about-us');
    })->name('about');

    Route::get('/community', function () {
        return view('community');
    })->name('community');

    Route::get('/blog', [BlogController::class, 'index'])->name('blog');

    Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('blog.detail');

    Route::get('/contact', function () {
        return view('contact');
    })->name('contact');

    Route::get('/product', [ProductController::class, 'index'])->name('product');

    Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.detail');

    Route::get('/bootcamp', [BootcampController::class, 'index'])->name('bootcamp');

    Route::get('/bootcamp/{id}', [BootcampController::class, 'show'])->name('bootcamp.detail');
    Route::get('/bootcamp-new/{id}', [BootcampController::class, 'showNew'])->name('bootcamp.new.detail');

    Route::get('/bootcamp-new', function () {
        return view('bootcamp-new');
    })->name('bootcamp.new');

    Route::get('/bootcamp-new/{id}', [BootcampController::class, 'showNew'])->name('bootcamp.new.detail');
});

// Redirect root to default language (Indonesian)
Route::get('/', function () {
    return redirect('/id');
});

// Authentication Routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Admin Routes
Route::prefix('admin')->middleware('admin')->group(function () {
    Route::get('/', function () {
        return redirect()->route('admin.dashboard');
    });

    Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('admin.dashboard');

    // Admin Management Routes
    Route::get('/admins', [App\Http\Controllers\Admin\AdminController::class, 'index'])->name('admin.admins');
    Route::get('/admins/create', [App\Http\Controllers\Admin\AdminController::class, 'create'])->name('admin.admins.create');
    Route::post('/admins', [App\Http\Controllers\Admin\AdminController::class, 'store'])->name('admin.admins.store');
    Route::get('/admins/{admin}/edit', [App\Http\Controllers\Admin\AdminController::class, 'edit'])->name('admin.admins.edit');
    Route::delete('/admins/{admin}', [App\Http\Controllers\Admin\AdminController::class, 'destroy'])->name('admin.admins.destroy');

    // Profile Routes
    Route::get('/profile', [App\Http\Controllers\AuthController::class, 'profile'])->name('admin.profile');
    Route::put('/profile', [App\Http\Controllers\AuthController::class, 'updateProfile'])->name('admin.profile.update');

    // Product Routes
    Route::get('/products', [App\Http\Controllers\Admin\ProductController::class, 'index'])->name('admin.products');
    Route::get('/products/create', [App\Http\Controllers\Admin\ProductController::class, 'create'])->name('admin.products.create');
    Route::post('/products', [App\Http\Controllers\Admin\ProductController::class, 'store'])->name('admin.products.store');
    Route::get('/products/{product}/edit', [App\Http\Controllers\Admin\ProductController::class, 'edit'])->name('admin.products.edit');
    Route::put('/products/{product}', [App\Http\Controllers\Admin\ProductController::class, 'update'])->name('admin.products.update');
    Route::delete('/products/{product}', [App\Http\Controllers\Admin\ProductController::class, 'destroy'])->name('admin.products.destroy');
    Route::patch('/products/{product}/toggle-active', [App\Http\Controllers\Admin\ProductController::class, 'toggleActive'])->name('admin.products.toggle-active');

    // Product Category Routes
    Route::get('/product-categories', [App\Http\Controllers\Admin\ProductCategoryController::class, 'index'])->name('admin.product-categories');
    Route::get('/product-categories/create', [App\Http\Controllers\Admin\ProductCategoryController::class, 'create'])->name('admin.product-categories.create');
    Route::post('/product-categories', [App\Http\Controllers\Admin\ProductCategoryController::class, 'store'])->name('admin.product-categories.store');
    Route::get('/product-categories/{productCategory}/edit', [App\Http\Controllers\Admin\ProductCategoryController::class, 'edit'])->name('admin.product-categories.edit');
    Route::put('/product-categories/{productCategory}', [App\Http\Controllers\Admin\ProductCategoryController::class, 'update'])->name('admin.product-categories.update');
    Route::delete('/product-categories/{productCategory}', [App\Http\Controllers\Admin\ProductCategoryController::class, 'destroy'])->name('admin.product-categories.destroy');
    Route::patch('/product-categories/{productCategory}/toggle-active', [App\Http\Controllers\Admin\ProductCategoryController::class, 'toggleActive'])->name('admin.product-categories.toggle-active');
    Route::post('/product-categories/update-sort', [App\Http\Controllers\Admin\ProductCategoryController::class, 'updateSort'])->name('admin.product-categories.update-sort');

    // Bootcamp Routes
    Route::get('/bootcamps', [App\Http\Controllers\Admin\BootcampController::class, 'index'])->name('admin.bootcamps');
    Route::get('/bootcamps/create', [App\Http\Controllers\Admin\BootcampController::class, 'create'])->name('admin.bootcamps.create');
    Route::post('/bootcamps', [App\Http\Controllers\Admin\BootcampController::class, 'store'])->name('admin.bootcamps.store');
    Route::get('/bootcamps/{bootcamp}/edit', [App\Http\Controllers\Admin\BootcampController::class, 'edit'])->name('admin.bootcamps.edit');
    Route::put('/bootcamps/{bootcamp}', [App\Http\Controllers\Admin\BootcampController::class, 'update'])->name('admin.bootcamps.update');
    Route::delete('/bootcamps/{bootcamp}', [App\Http\Controllers\Admin\BootcampController::class, 'destroy'])->name('admin.bootcamps.destroy');
    Route::patch('/bootcamps/{bootcamp}/toggle-active', [App\Http\Controllers\Admin\BootcampController::class, 'toggleActive'])->name('admin.bootcamps.toggle-active');

    // Category Routes
    Route::get('/categories', [App\Http\Controllers\Admin\CategoryController::class, 'index'])->name('admin.categories');
    Route::get('/categories/create', [App\Http\Controllers\Admin\CategoryController::class, 'create'])->name('admin.categories.create');
    Route::post('/categories', [App\Http\Controllers\Admin\CategoryController::class, 'store'])->name('admin.categories.store');
    Route::get('/categories/{category}/edit', [App\Http\Controllers\Admin\CategoryController::class, 'edit'])->name('admin.categories.edit');
    Route::put('/categories/{category}', [App\Http\Controllers\Admin\CategoryController::class, 'update'])->name('admin.categories.update');
    Route::delete('/categories/{category}', [App\Http\Controllers\Admin\CategoryController::class, 'destroy'])->name('admin.categories.destroy');
    Route::patch('/categories/{category}/toggle-active', [App\Http\Controllers\Admin\CategoryController::class, 'toggleActive'])->name('admin.categories.toggle-active');
    Route::post('/categories/update-sort', [App\Http\Controllers\Admin\CategoryController::class, 'updateSort'])->name('admin.categories.update-sort');

    // Mentor Routes
    Route::get('/mentors', [App\Http\Controllers\Admin\MentorController::class, 'index'])->name('admin.mentors');
    Route::get('/mentors/create', [App\Http\Controllers\Admin\MentorController::class, 'create'])->name('admin.mentors.create');
    Route::post('/mentors', [App\Http\Controllers\Admin\MentorController::class, 'store'])->name('admin.mentors.store');
    Route::get('/mentors/{mentor}/edit', [App\Http\Controllers\Admin\MentorController::class, 'edit'])->name('admin.mentors.edit');
    Route::put('/mentors/{mentor}', [App\Http\Controllers\Admin\MentorController::class, 'update'])->name('admin.mentors.update');
    Route::delete('/mentors/{mentor}', [App\Http\Controllers\Admin\MentorController::class, 'destroy'])->name('admin.mentors.destroy');
    Route::patch('/mentors/{mentor}/toggle-active', [App\Http\Controllers\Admin\MentorController::class, 'toggleActive'])->name('admin.mentors.toggle-active');

    // Blog Routes
    Route::get('/blogs', [App\Http\Controllers\Admin\BlogController::class, 'index'])->name('admin.blogs');
    Route::get('/blogs/create', [App\Http\Controllers\Admin\BlogController::class, 'create'])->name('admin.blogs.create');
    Route::post('/blogs', [App\Http\Controllers\Admin\BlogController::class, 'store'])->name('admin.blogs.store');
    Route::get('/blogs/{blog}/edit', [App\Http\Controllers\Admin\BlogController::class, 'edit'])->name('admin.blogs.edit');
    Route::put('/blogs/{blog}', [App\Http\Controllers\Admin\BlogController::class, 'update'])->name('admin.blogs.update');
    Route::delete('/blogs/{blog}', [App\Http\Controllers\Admin\BlogController::class, 'destroy'])->name('admin.blogs.destroy');
    Route::patch('/blogs/{blog}/toggle-active', [App\Http\Controllers\Admin\BlogController::class, 'toggleActive'])->name('admin.blogs.toggle-active');

    // Blog Tag Routes
    Route::get('/blog-tags', [App\Http\Controllers\Admin\BlogTagController::class, 'index'])->name('admin.blog-tags');
    Route::get('/blog-tags/create', [App\Http\Controllers\Admin\BlogTagController::class, 'create'])->name('admin.blog-tags.create');
    Route::post('/blog-tags', [App\Http\Controllers\Admin\BlogTagController::class, 'store'])->name('admin.blog-tags.store');
    Route::get('/blog-tags/{blogTag}/edit', [App\Http\Controllers\Admin\BlogTagController::class, 'edit'])->name('admin.blog-tags.edit');
    Route::put('/blog-tags/{blogTag}', [App\Http\Controllers\Admin\BlogTagController::class, 'update'])->name('admin.blog-tags.update');
    Route::delete('/blog-tags/{blogTag}', [App\Http\Controllers\Admin\BlogTagController::class, 'destroy'])->name('admin.blog-tags.destroy');
    Route::patch('/blog-tags/{blogTag}/toggle-active', [App\Http\Controllers\Admin\BlogTagController::class, 'toggleActive'])->name('admin.blog-tags.toggle-active');

    // Settings
    Route::get('/settings', function () {
        return view('admin.settings');
    })->name('admin.settings');

    // // Profile
    // Route::get('/profile', function () {
    //     return view('admin.profile');
    // })->name('admin.profile');
});

// Mentor Routes
Route::prefix('mentor')->group(function () {
    Route::get('/dashboard', function () {
        return view('mentor.dashboard');
    })->name('mentor.dashboard');

    Route::get('/bootcamps', function () {
        return view('mentor.bootcamps');
    })->name('mentor.bootcamps');

    Route::get('/materials', function () {
        return view('mentor.materials');
    })->name('mentor.materials');

    Route::get('/announcements', function () {
        return view('mentor.announcements');
    })->name('mentor.announcements');

    Route::get('/students', function () {
        return view('mentor.students');
    })->name('mentor.students');

    Route::get('/profile', function () {
        return view('mentor.profile');
    })->name('mentor.profile');

    Route::get('/settings', function () {
        return view('mentor.settings');
    })->name('mentor.settings');
});
