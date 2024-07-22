<?php

use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Livewire\ListBookings;
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

Route::get('/', [HomeController::class, 'index'])->name('home');

// Route::get('/checkout/success', function () {
//     return view('pages.checkout-success');
// })->name('checkout.success');

Route::get('/sign-in', function () {
    return view('pages.sign-in');
})->name('sign-in');

Route::get('/sign-up', function () {
    return view('pages.sign-up');
})->name('sign-up');

require __DIR__.'/auth.php';

Route::middleware(['auth'])->group(function() {
    Route::get('checkout/success', [CheckoutController::class, 'success'])->name('checkout.success');
    Route::post('{username}/checkout', [CheckoutController::class, 'checkout'])->name('checkout');
    Route::get('{username}/checkout/{bookingId}', [CheckoutController::class, 'show'])->name('checkout.show');
    // Route::get('{username}/checkout/{bookingId}/success', [CheckoutController::class, 'success'])->name('checkout.success');
});

Route::get('{username}/available-time/{date}/{hours}', [ProfileController::class, 'getAvailableTime'])->name('profile.get-available-time');
Route::get('{username}', [ProfileController::class, 'show'])->name('profile');

// Route::prefix('admin')->middleware(['auth', "role:{User::ROLE_ADMIN}"])->group(function () {
//     Route::resource('bookings', ListBookings::class);
// });