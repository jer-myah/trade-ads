<?php

// user routes

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::group(['middleware' => ['auth', 'verified', 'isuser']], function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Users/Dashboard');
    })->name('dashboard');

    Route::get('/user-account-information', [App\Http\Controllers\UserController::class, 'accountInformation']);

    Route::get('/user-adverts', [App\Http\Controllers\AdvertController::class, 'index']);
    Route::get('/user/place-advert', [App\Http\Controllers\AdvertController::class, 'create']);
    Route::post('/user/place-advert', [App\Http\Controllers\AdvertController::class, 'store']);
    Route::get('/user/edit-advert/{id}', [App\Http\Controllers\AdvertController::class, 'edit']);
    Route::post('/user/update-advert/{id}', [App\Http\Controllers\AdvertController::class, 'post']);

});