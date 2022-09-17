<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

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

//Route::get('/', function () {
//    return view('home');
//});




Auth::routes();

Route::group(
    [   // بيجبلي اخر لغه انا كنت فاتح بيها الموقع دا لما اقفله واجي افتحه تاني من جديد => localeSessionRedirect
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']  // دول اللي حطيتهم ف ملف ال kernel.php
    ], function () {


    Route::group(['middleware' => ['auth'], 'namespace' => 'Frontend'], function () {
        Route::get('/', [App\Http\Controllers\Frontend\FrontendController::class, 'index'])->name('home');
        Route::post('submitContact', [App\Http\Controllers\Frontend\ContactController::class, 'submitContact'])->name('submitContact');
        Route::get('category', [App\Http\Controllers\Frontend\FrontendController::class, 'category'])->name('category');
        Route::get('view-category/{id}', [App\Http\Controllers\Frontend\FrontendController::class, 'ViewCategory'])->name('view_category');
        Route::get('view-product/{catId}/{prodId}', [App\Http\Controllers\Frontend\FrontendController::class, 'ViewProduct'])->name('view_product');
        Route::post('add-to-cart', [App\Http\Controllers\Frontend\CartController::class, 'addProduct']);
        Route::get('cart', [App\Http\Controllers\Frontend\CartController::class, 'viewCart'])->name('cart');
        Route::post('delete-cart-item', [App\Http\Controllers\Frontend\CartController::class, 'deletecartItem']);
        Route::post('update-cart-items', [App\Http\Controllers\Frontend\CartController::class, 'updateCartItems'])->name('update-cart-items');
        Route::get('checkOut', [App\Http\Controllers\Frontend\CheckOutController::class, 'index'])->name('checkOut');
        Route::post('place-order', [App\Http\Controllers\Frontend\CheckOutController::class, 'PlaceOrder'])->name('place-order');
        Route::get('my-order', [App\Http\Controllers\Frontend\OrderController::class, 'index'])->name('my-order');
        Route::get('view-my-order/{id}', [App\Http\Controllers\Frontend\OrderController::class, 'view'])->name('view-my-order');
        Route::post('delete-my-order/{id}', [App\Http\Controllers\Frontend\OrderController::class, 'deleteOrder'])->name('delete-my-order');
//    Notification on cart icons
        Route::get('load-cart-data', [App\Http\Controllers\Frontend\CartController::class, 'cartCount']);
//   Search product in laravel | Ajax auto complete
        Route::get('product-list', [App\Http\Controllers\Frontend\FrontendController::class, 'productListAjax']);
        Route::post('searchProduct', [App\Http\Controllers\Frontend\FrontendController::class, 'searchProduct']);

        Route::post('proceed-to-pay', [App\Http\Controllers\Frontend\CheckOutController::class, 'razorpayCheck']);
    });

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

include('admin.php');

});
