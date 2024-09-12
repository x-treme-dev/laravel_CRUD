<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GitHubUserController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\DbController;
use App\Http\Controllers\OrderController;

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
 
Route::get('/', function () {
    return view('welcome');
}); 
 

Route::get('/orders', [ OrderController::class, 'index' ] )->name('order.list');
Route::post('/orders', [ OrderController::class, 'store' ] )->name('order.store');
Route::get('/order/create', [ OrderController::class, 'create' ] )->name('order.create');
Route::get('/order/{order}', [ OrderController::class, 'show' ] )->name('order.show');
Route::patch('/order/{order}', [ OrderController::class, 'update' ] )->name('order.update');
Route::delete('/order/{order}', [ OrderController::class, 'destroy' ] )->name('order.destroy');
Route::get('/order/edit/{order}', [ OrderController::class, 'edit' ] )->name('order.edit');

/// php artisan make:request Order/StoreRequest
// php artisan vendor:publish --tag=laravel-pagination
