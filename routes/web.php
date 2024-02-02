<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('pages.home');
})->name('home');

Route::get('/profile', function () {
    return view('pages.profile');
})->name('profile');

Route::get('/checkout', function () {
    return view('pages.checkout');
})->name('checkout');

Route::get('/checkout/success', function () {
    return view('pages.checkout-success');
})->name('checkout.success');

Route::get('/sign-in', function () {
    return view('pages.sign-in');
})->name('sign-in');

Route::get('/sign-up', function () {
    return view('pages.sign-up');
})->name('sign-up');
