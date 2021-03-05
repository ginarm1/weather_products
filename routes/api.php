<?php

use App\Http\Controllers\ProductController;
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


//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});
// Products API
Route::get('products',[ProductController::class,'index']);

Route::prefix('products') -> group( function () {
//    Get particular product
    Route::get('{id}',[ProductController::class,'show']);
//    Get recommended products by a particular city
    Route::get('recommended/{city}',[ProductController::class,'recommended']);
});

