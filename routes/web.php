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
Route::post('/events/create', [EventController::class, 'store'])->middleware('auth');
Route::get('/events/{id}', [EventController::class, 'show']);
Route::delete('/events/{id}', [EventController::class, 'destroy'])->middleware('auth');
Route::get('/events/edit/{id}', [EventController::class, 'edit'])->middleware('auth');
Route::put('/events/update/{id}', [EventController::class, 'update'])->middleware('auth');
Route::post('/events/join/{id}', [EventController::class, 'joinEvent'])->middleware('auth');
Route::get('/products', fn () => view('products'));
Route::delete('/events/user/{id}', [EventController::class, 'leaveEvent'])->middleware('auth');



Route::get('/product/{id?}', function ($id = null) {
  return view('product', ['id' => $id]);
});

Route::get('/products', [ProductController::class, 'index']);

Route::get('/contact', fn () => view('contacts'));

Route::get('/dashboard', [EventController::class, 'dashboard'])->middleware('auth');
