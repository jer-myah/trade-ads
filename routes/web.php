<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use App\Models\User;

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
    return Inertia::render('About');
});
Route::post('/create-trader', [App\Http\Controllers\GeneralController::class, 'store']);
// Route::get('/thank', function () { return Inertia::render('ThankYou'); });

Route::get('/blockonomics', [App\Http\Controllers\BitcoinPaymentController::class, 'store']);



// user routes
Route::group(['middleware' => ['auth', 'verified', 'isuser']], function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Users/Dashboard');
    })->name('dashboard');


    Route::get('/user-account-information', function () {
        return Inertia::render('Users/AccountInformation');
    });

    Route::get('/user-adverts', [App\Http\Controllers\AdvertController::class, 'index']);
    Route::get('/user/place-advert', [App\Http\Controllers\AdvertController::class, 'create']);
    Route::post('/user/place-advert', [App\Http\Controllers\AdvertController::class, 'store']);
    Route::get('/user/edit-advert/{id}', [App\Http\Controllers\AdvertController::class, 'edit']);
    Route::post('/user/update-advert/{id}', [App\Http\Controllers\AdvertController::class, 'post']);

});

// traders routes
Route::group(['middleware' => ['auth', 'verified', 'istrader']], function() {
    Route::get('/trader-dashboard', [App\Http\Controllers\TradersController::class, 'index']);
    Route::get('/available-links', [App\Http\Controllers\TradersController::class, 'availableLinks']);
    Route::get('/tradeable-links', [App\Http\Controllers\TradersController::class, 'tradeableLinks']);
    Route::get('/trading-section', [App\Http\Controllers\TradersController::class, 'tradingSection']);
    Route::get('/account-information', [App\Http\Controllers\TradersController::class, 'accountInformation']);
});



// voluntary traders routes
// Route::get('/trader-dashboard', function () {
//     return Inertia::render('VoluntaryTraders/Dashboard');
// })->middleware(['auth', 'verified', 'istrader'])->name('trader-dashboard');



// admin routes
Route::group(['middleware' => ['auth', 'verified', 'isadmin']], function () {
    Route::get('/admin-dashboard', function () {
        $total_users = User::where('role', '!=', 'administrator')->count();
        return Inertia::render('Admin/Dashboard', ['total_users' => $total_users]);
    })->name('admin-dashboard');

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
    Route::get('/admin/approve-advert/{id}', [App\Http\Controllers\AdvertController::class, 'approveAdvert']);
    Route::get('/admin/delete-advert/{id}', [App\Http\Controllers\AdvertController::class, 'deleteAdvert']);

    Route::get('/admin/view-links', [App\Http\Controllers\LinkController::class, 'index']);
    Route::post('/admin/share-link', [App\Http\Controllers\LinkController::class, 'share']);
});
    

require __DIR__.'/auth.php';
