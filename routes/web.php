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

    Route::get('/products', function () {
        return view('admin.products');
    })->name('admin.products');

    Route::get('/bootcamps', function () {
        return view('admin.bootcamps');
    })->name('admin.bootcamps');

    Route::get('/mentors', function () {
        return view('admin.mentors');
    })->name('admin.mentors');

    Route::get('/blogs', function () {
        return view('admin.blogs');
    })->name('admin.blogs');

    Route::get('/settings', function () {
        return view('admin.settings');
    })->name('admin.settings');
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
