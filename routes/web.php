<?php

use App\Http\Controllers\HomeController;
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
Route::get('/',                 [HomeController::class, 'index'])->name('home');
Route::get('/home',             [HomeController::class, 'index'])->name('home');
