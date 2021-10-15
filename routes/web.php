<?php

use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Productcontroller;

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

Route::get('/', [Productcontroller::class, 'product']);
Route::post('/add_product', [Productcontroller::class,'add_product']);
Route::post('/update_product', [Productcontroller::class,'update_product']);
Route::post('/delete_product', [Productcontroller::class,'delete_product']);
Route::get('/get_product', [Productcontroller::class,'get_product']);
Route::put('/update_productByid', [Productcontroller::class,'update_productByid']);

Route::get('/login', [LoginController::class, 'login']);
Route::get('/logout', [LoginController::class, 'logout']);
Route::post('/signin', [LoginController::class, 'signin']);
Route::post('/loginsuccess', [LoginController::class, 'loginsuccess']);
