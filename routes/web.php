<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
	 return view('home');
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

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::get('/product', function () {
    return view('product');
})->name('product');
