<?php

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
// Overcharge logout route, it appears to be POST originally and it cannot be
Route::get('logout', 'App\Http\Controllers\Auth\LoginController@logout')->name('logout');

// User routes
Route::get('/',                     [HomeController::class, 'index'])->name('home');
Route::get('/home',                 [HomeController::class, 'index'])->name('home');
Route::get('/animals',              [AnimalController::class, 'all'])->name('animals');
Route::get('/animal/{animal}',      [AnimalController::class, 'index'])->name('animal');
Route::get('/category/{category}',  [CategoryController::class, 'index'])->name('category');
Route::get('/product/{id}',         [ProductController::class, 'index'])->name('product');
Route::get('/cart',                 [CartController::class, 'index'])->name('cart');
Route::get('/cart/delete/{id}',     [CartController::class, 'delete'])->name('cart.delete');
Route::get('/search',               [ProductController::class, 'search'])->name('search');
Route::get('/pay',                  [PayController::class, 'index'])->name('pay');
Route::post('/pay/response',        [PayController::class, 'pay'])->name('pay.response');
