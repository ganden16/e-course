<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\BootcampController;
use App\Http\Controllers\ProductController;

// Language switch route
Route::get('/lang/{locale}', [LanguageController::class, 'switch'])->name('language.switch');

// Group routes with language prefix
Route::group(['prefix' => '{locale}', 'where' => ['locale' => 'id|en']], function () {
    Route::get('/', function () {
        return view('welcome');
    })->name('welcome');

    Route::get('/about-us', function () {
        return view('about-us');
    })->name('about');

    Route::get('/community', function () {
        return view('community');
    })->name('community');

    Route::get('/blog', function () {
        return view('blog');
    })->name('blog');

    Route::get('/blog/{id}', function ($id) {
        return view('blog-detail');
    })->name('blog.detail');

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
Route::get('/login', function () {
    return view('login');
})->name('login');

// Admin Routes
Route::prefix('admin')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    Route::get('/users', function () {
        return view('admin.users');
    })->name('admin.users');

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
    Route::get('/mentors', function () {
        return view('admin.mentors.index');
    })->name('admin.mentors');

    Route::get('/mentors/create', function () {
        return view('admin.mentors.form');
    })->name('admin.mentors.create');

    Route::get('/mentors/{id}/edit', function ($id) {
        return view('admin.mentors.form', ['mentor' => $id]);
    })->name('admin.mentors.edit');

    // Blog Routes
    Route::get('/blogs', function () {
        return view('admin.blogs');
    })->name('admin.blogs');

    Route::get('/blogs/create', function () {
        return view('admin.blogs.form');
    })->name('admin.blogs.create');

    Route::get('/blogs/{id}/edit', function ($id) {
        return view('admin.blogs.form', ['blog' => $id]);
    })->name('admin.blogs.edit');

    // Settings
    Route::get('/settings', function () {
        return view('admin.settings');
    })->name('admin.settings');

    // Profile
    Route::get('/profile', function () {
        return view('admin.profile');
    })->name('admin.profile');
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
