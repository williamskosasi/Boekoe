<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RegisterController;

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
Route::get('/addBooks', [AdminController::class, 'addBooks'])->middleware('admin');
Route::get('/manageBooks', [AdminController::class, 'manageBooks'])->middleware('admin');
Route::get('/admin', [AdminController::class, 'index'])->middleware('admin');

Route::get('/cart', [CartController::class, 'index'])->middleware('auth');
Route::post('/cartInsert', [CartController::class, 'store'])->middleware('auth');
Route::post('/cartUpdate', [CartController::class, 'update'])->middleware('auth');
Route::post('/cartDelete', [CartController::class, 'delete'])->middleware('auth');
Route::get('/cartCheckout', [CartController::class, 'checkout'])->middleware('auth');

Route::post('/doOrder', [OrderController::class, 'do'])->middleware('auth');
Route::get('/order', [OrderController::class, 'index'])->middleware('auth');
Route::post('/uploadImage', [OrderController::class, 'uploadImage'])->middleware('auth');
Route::post('/viewDetail', [OrderController::class, 'viewDetail'])->middleware('auth');

Route::get('/login', [LoginController::class, 'index'])->middleware('guest');
Route::post('/login', [LoginController::class, 'auth'])->name('login');
Route::post('/logout', [LoginController::class, 'logout']);

Route::get('/register', [RegisterController::class, 'index'])->middleware('guest');
Route::post('/register', [RegisterController::class, 'store']);

Route::get('/', [ProductController::class, 'index']);
Route::get('/{product:slug}', [ProductController::class, 'detail'])->middleware('auth');

Route::post('/viewDetailAdmin', [AdminController::class, 'viewDetail'])->middleware('admin');
Route::post('/viewImage', [AdminController::class, 'viewImage'])->middleware('admin');
Route::post('/updateStatus', [AdminController::class, 'updateStatus'])->middleware('admin');
Route::post('/setAvailable',[AdminController::class, 'setAvailable'])->middleware('admin');
Route::post('/editPrice',[AdminController::class, 'editPrice'])->middleware('admin');
Route::get('/addBooks',[AdminController::class, 'addBooksPage'])->middleware('admin');
Route::post('/addBooks',[AdminController::class, 'addBooks'])->middleware('admin');