<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LanguageController;

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
        return view('blog-detail', ['id' => $id]);
    })->name('blog.detail');

    Route::get('/contact', function () {
        return view('contact');
    })->name('contact');

    Route::get('/product', function () {
        return view('product');
    })->name('product');

    Route::get('/product/{id}', function ($id) {
        return view('product-detail', ['id' => $id]);
    })->name('product.detail');

    Route::get('/bootcamp', function () {
        return view('bootcamp');
    })->name('bootcamp');

    Route::get('/bootcamp/{id}', function ($id) {
        return view('bootcamp-detail', ['id' => $id]);
    })->name('bootcamp.detail');
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
    Route::get('/products', function () {
        return view('admin.products.index');
    })->name('admin.products');

    Route::get('/products/create', function () {
        return view('admin.products.form');
    })->name('admin.products.create');

    Route::get('/products/{id}/edit', function ($id) {
        return view('admin.products.form', ['product' => $id]);
    })->name('admin.products.edit');

    // Bootcamp Routes
    Route::get('/bootcamps', function () {
        return view('admin.bootcamps.index');
    })->name('admin.bootcamps');

    Route::get('/bootcamps/create', function () {
        return view('admin.bootcamps.form');
    })->name('admin.bootcamps.create');

    Route::get('/bootcamps/{id}/edit', function ($id) {
        return view('admin.bootcamps.form', ['bootcamp' => $id]);
    })->name('admin.bootcamps.edit');

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
