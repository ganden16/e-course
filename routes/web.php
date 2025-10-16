<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

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
