<?php


// admin routes

use App\Models\User;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::group(['middleware' => ['auth', 'verified', 'isadmin']], function () {
    Route::get('/admin-dashboard', [App\Http\Controllers\DashboardController::class, 'adminDashboard'])->name('admin-dashboard');

    Route::get('/admin/view-users', [App\Http\Controllers\UserController::class, 'index']);
    Route::get('/admin/view/user-details/{id}', [App\Http\Controllers\UserController::class, 'show']);
    Route::get('/admin/approve-trader/{id}', [App\Http\Controllers\UserController::class, 'approveTrader']);

    Route::get('/admin/view-categories', [App\Http\Controllers\AdvertCategoryController::class, 'index']);
    Route::get('/admin/view/category-details/{id}', [App\Http\Controllers\AdvertCategoryController::class, 'show']);
    Route::get('/admin/create-category', [App\Http\Controllers\AdvertCategoryController::class, 'create']);
    Route::post('/admin/store-category', [App\Http\Controllers\AdvertCategoryController::class, 'store']);
    Route::get('/admin/edit-category/{id}', [App\Http\Controllers\AdvertCategoryController::class, 'edit']);
    Route::post('/admin/update-category/{id}', [App\Http\Controllers\AdvertCategoryController::class, 'update']);
    Route::get('/admin/disable-category/{id}', [App\Http\Controllers\AdvertCategoryController::class, 'disable']);
    Route::get('/admin/enable-category/{id}', [App\Http\Controllers\AdvertCategoryController::class, 'enable']);
    Route::get('/admin/delete-category/{id}', [App\Http\Controllers\AdvertCategoryController::class, 'destroy']);

    Route::get('/admin/view-packages', ['App\Http\Controllers\AdvertPackageController', 'index']);
    Route::get('/admin/view/package-details/{id}', ['App\Http\Controllers\AdvertPackageController', 'show']);
    Route::get('/admin/create-package', ['App\Http\Controllers\AdvertPackageController', 'create']);
    Route::post('/admin/store-package', ['App\Http\Controllers\AdvertPackageController', 'store']);
    Route::get('/admin/edit-package/{id}', ['App\Http\Controllers\AdvertPackageController', 'edit']);
    Route::post('/admin/update-package/{id}', ['App\Http\Controllers\AdvertPackageController', 'update']);
    Route::get('/admin/disable-package/{id}', ['App\Http\Controllers\AdvertPackageController', 'disable']);
    Route::get('/admin/enable-package/{id}', ['App\Http\Controllers\AdvertPackageController', 'enable']);
    Route::get('/admin/delete-package/{id}', ['App\Http\Controllers\AdvertPackageController', 'destroy']);

    Route::get('/admin/payments', [App\Http\Controllers\BitcoinPaymentController::class, 'index']);
    Route::get('/admin/credit/{id}', [App\Http\Controllers\BitcoinPaymentController::class, 'update']);

    Route::get('/admin/view-adverts', [App\Http\Controllers\AdvertController::class, 'index']);
    Route::get('/admin/show-advert/{id}', [App\Http\Controllers\AdvertController::class, 'show']);
    Route::get('/admin/deactivate-advert/{id}', [App\Http\Controllers\AdvertController::class, 'deactivate']);
    Route::get('/admin/approve-advert/{id}', [App\Http\Controllers\AdvertController::class, 'approveAdvert']);
    Route::get('/admin/delete-advert/{id}', [App\Http\Controllers\AdvertController::class, 'deleteAdvert']);

    Route::get('/admin/view-links', [App\Http\Controllers\LinkController::class, 'index']);
    Route::post('/admin/share-link', [App\Http\Controllers\LinkController::class, 'share']);
    
});