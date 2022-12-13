<?php

use App\Http\Controllers\AdminCategoryController;
use App\Http\Controllers\AdminOrderController;
use App\Http\Controllers\AdminPresentationController;
use App\Http\Controllers\AdminProductController;
use App\Http\Controllers\AnimalController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PayController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Auth::routes();

/**
 * * USER ROUTES
 */
Route::get('/',                     [HomeController::class, 'index'])->name('home');
Route::get('/home',                 [HomeController::class, 'index']);
Route::get('/animals',              [AnimalController::class, 'all'])->name('animals');
Route::get('/animal/{animal}',      [AnimalController::class, 'index'])->name('animal');
Route::get('/category/{category}',  [CategoryController::class, 'index'])->name('category');
Route::get('/product/{id}',         [ProductController::class, 'index'])->name('product');
Route::get('/cart',                 [CartController::class, 'index'])->name('cart');
Route::get('/cart/delete/{id}',     [CartController::class, 'delete'])->name('cart.delete');
Route::get('/search',               [ProductController::class, 'search'])->name('search');
Route::get('/pay',                  [PayController::class, 'index'])->name('pay');
Route::post('/pay/response',        [PayController::class, 'pay'])->name('pay.response');
Route::get('/pay/confirm',          [PayController::class, 'confirm'])->name('pay.confirm');


/**
 * * ADMIN ROUTES
 */
Route::prefix('admin')->group(function () {
    Route::group(['middleware' => ['can:edit_settings']], function () {
        
    });
    
    Route::group(['middleware' => ['can:edit_products']], function () {
        // Products
        Route::resource('products', AdminProductController::class);
        Route::get('products/available/{id}',       [AdminProductController::class, 'toggleAvailability'])->name('products.available');
        // Presentations
        Route::get('presentations/create/{id}',     [AdminPresentationController::class, 'create'])->name('presentations.create');
        Route::post('presentations/store',          [AdminPresentationController::class, 'store'])->name('presentations.store');
        Route::get('presentations/edit/{id}',       [AdminPresentationController::class, 'edit'])->name('presentations.edit');
        Route::post('presentations/update',         [AdminPresentationController::class, 'update'])->name('presentations.update');
        Route::get('presentations/available/{id}',  [AdminPresentationController::class, 'toggleAvailability'])->name('presentations.available');
        // Categories
        Route::resource('categories', AdminCategoryController::class);
    });
    
    Route::group(['middleware' => ['can:view_orders']], function () {
        Route::get('orders',            [AdminOrderController::class, 'index'])->name('orders');
        Route::get('orders/show/{id}',  [AdminOrderController::class, 'show'])->name('orders.show');
    });
});