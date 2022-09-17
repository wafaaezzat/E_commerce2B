<?php
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


//isAdmin =>set in kernel.php
Route::group(['middleware' => ['auth', 'isAdmin']], function () {

    Route::get('dashboard', [App\Http\Controllers\Admin\FrontendController::class, 'index']);
    Route::get('categories', [App\Http\Controllers\Admin\CategoryController::class, 'index']);
    Route::get('add-category', [App\Http\Controllers\Admin\CategoryController::class, 'add']);
    Route::post('store-category', [App\Http\Controllers\Admin\CategoryController::class, 'store']);
    Route::get('edit-category/{id}', [App\Http\Controllers\Admin\CategoryController::class, 'edit'])->name('edit-category');
    Route::PUT('update-category/{id}', [App\Http\Controllers\Admin\CategoryController::class, 'update'])->name('update-category');
    Route::get('delete-category/{id}', [App\Http\Controllers\Admin\CategoryController::class, 'delete'])->name('delete-category');

//    Products
    Route::resource('products', App\Http\Controllers\Admin\ProductController::class);

//    Orders
    Route::resource('orders', App\Http\Controllers\Admin\OrderController::class);
    Route::get('ordersHistory', [App\Http\Controllers\Admin\OrderController::class, 'ordersHistory'])->name('ordersHistory');

//    Contacts
    Route::resource('Contacts' , App\Http\Controllers\Admin\ContactController::class);

//    Users
    Route::get('users', [App\Http\Controllers\Admin\FrontendController::class, 'users'])->name('users');
    Route::get('usersView/{id}', [App\Http\Controllers\Admin\FrontendController::class, 'usersView'])->name('usersView');

});
