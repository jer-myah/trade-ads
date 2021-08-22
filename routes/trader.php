<?php

// traders routes

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth', 'verified', 'istrader']], function() {
    Route::get('/trader-dashboard', [App\Http\Controllers\TradersController::class, 'index']);
    Route::get('/available-links', [App\Http\Controllers\TradersController::class, 'availableLinks']);
    Route::get('/tradeable-links', [App\Http\Controllers\TradersController::class, 'tradeableLinks']);
    Route::get('/trading-section', [App\Http\Controllers\TradersController::class, 'tradingSection']);
    Route::get('/account-information', [App\Http\Controllers\TradersController::class, 'accountInformation']);
    Route::get('/purchase-adslink/{link}', [App\Http\Controllers\LinkController::class, 'purchaseAdslink']);
    Route::get('/purchase-trader-adslink/{id}', [App\Http\Controllers\LinkController::class, 'purchaseTraderLink']);

    Route::get('/sharable-links', [App\Http\Controllers\LinkController::class, 'sharableLinks']);

    Route::get('/profile', [App\Http\Controllers\UserController::class, 'profile']);
    
});

Route::get('/advert-details/{advert_id}', [App\Http\Controllers\AdvertController::class, 'advertDetails']);