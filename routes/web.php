<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ItemController;
use App\Http\Controllers\Admin\ReservationController;
use App\Http\Controllers\Admin\UserMessageController;

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

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['prefix' => 'admin', "middleware" => 'auth'], function() {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::resource('slider',SliderController::class);
    Route::resource('category',CategoryController::class);
    Route::resource('item',ItemController::class);
    Route::resource('reservation',ReservationController::class);
    Route::resource('message',UserMessageController::class);
});
