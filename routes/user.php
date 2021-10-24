<?php

// user routes

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::group(['middleware' => ['auth', 'verified', 'isuser']], function () {
    Route::get('/dashboard', [App\http\Controllers\UserController::class, 'dashboard'])->name('dashboard');
    
    Route::get('/user-account-information', [App\Http\Controllers\UserController::class, 'accountInformation']);
    Route::get('/profile-information', [App\Http\Controllers\UserController::class, 'userProfile']);

    Route::get('/user-adverts', [App\Http\Controllers\AdvertController::class, 'index']);
    Route::get('/user/place-advert', [App\Http\Controllers\AdvertController::class, 'create']);
    Route::post('/user/place-advert', [App\Http\Controllers\AdvertController::class, 'store']);
    Route::get('/user/view-advert/{id}', [App\Http\Controllers\AdvertController::class, 'viewAdvert']);
    Route::get('/user/edit-advert/{id}', [App\Http\Controllers\AdvertController::class, 'edit']);
    Route::post('/user/update-advert/{id}', [App\Http\Controllers\AdvertController::class, 'update']);
    Route::post('/user/update-advert-image/{id}', [App\Http\Controllers\AdvertController::class, 'updateImage']);

    Route::post('/update-password', [App\Http\Controllers\UserController::class, 'updatePassword']);
    
});