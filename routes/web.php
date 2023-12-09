<?php

use App\Http\Controllers\Admin\MessageController;
use App\Http\Controllers\Admin\SponsorshipController;
use App\Http\Controllers\BraintreeController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\ApartmentController;
use App\Http\Controllers\Admin\PageController as AdminPageController;
use App\Http\Controllers\Guest\PageController as GuestPageController;

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

Route::get('/', [GuestPageController::class, 'index'])->name('guest.home');


Route::middleware(['auth', 'verified'])
  ->prefix('admin')
  ->name('admin.')
  ->group(function () {

    Route::get('/', [AdminPageController::class, 'index'])->name('home');
    Route::resource('apartments', ApartmentController::class);
    Route::resource('messages', MessageController::class);
    Route::resource('sponsorships', SponsorshipController::class);
    Route::post('/apartments/sponsorize', [ApartmentController::class, 'sponsorize'])->name('apartments.sponsorize');
    Route::any('/payment', [BraintreeController::class, 'token'])->name('token');

  });

require __DIR__ . '/auth.php';