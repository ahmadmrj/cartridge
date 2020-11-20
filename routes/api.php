<?php

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('customer', 'API\CrmCustomersController')->middleware('apiauth');
Route::resource('products', 'API\ProductController')->middleware('apiauth');
Route::resource('category', 'API\CategoryController')->middleware('apiauth');
Route::resource('supplier', 'API\SupplierController')->middleware('apiauth');
Route::resource('apilog', 'API\ShopApiLogController')->middleware('apiauth');
Route::post('auth', 'API\AuthController@index');
