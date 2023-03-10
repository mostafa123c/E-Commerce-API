<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::group(['prefix' => 'auth'] , function (){
    Route::post('register' , [AuthController::class , 'register']);
    Route::post('login' , [AuthController::class , 'login']);
});

Route::get('products' , [ProductsController::class , 'products']);

Route::group(['prefix' => 'cart' , 'middleware' => 'jwtAuth'] , function (){
    Route::get('user' , [CartController::class , 'usercart']);
    Route::post('add' , [CartController::class , 'addtocart']);
    Route::post('delete' , [CartController::class , 'deletefromcart']);
    Route::post('update' , [CartController::class , 'updatecart']);
});

Route::post('checkout' , [OrderController::class, 'checkout']);


