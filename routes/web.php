<?php

use App\Http\Controllers\EventController;
use App\Http\Controllers\ProductController;
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

Route::get('/', [EventController::class, 'index']);

Route::get('/events/create', [EventController::class, 'create']);
Route::post('/events/create', [EventController::class, 'store']);
Route::get('/events/{id}', [EventController::class, 'show']);

Route::get('/products', fn () => view('products'));



Route::get('/product/{id?}', function ($id = null) {
  return view('product', ['id' => $id]);
});

Route::get('/products', [ProductController::class, 'index']);

Route::get('/contact', fn () => view('contacts'));

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
