<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use App\Models\User;
use App\Traits\Values;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [App\Http\Controllers\GeneralController::class, 'index']);

Route::get('/how-it-works', function () {
    $countries = Values::COUNTRIES;
    return Inertia::render('About', ['countries' => $countries]);
});
Route::post('/create-trader', [App\Http\Controllers\GeneralController::class, 'store']);
// Route::get('/thank', function () { return Inertia::render('ThankYou'); });

Route::get('/blockonomics', [App\Http\Controllers\BitcoinPaymentController::class, 'store']);

Route::get('/credit-account', [App\Http\Controllers\GeneralController::class, 'credit']);
Route::get('/credit-account/{id}', [App\Http\Controllers\GeneralController::class, 'creditId']);

require __DIR__.'/auth.php';
