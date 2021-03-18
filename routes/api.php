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

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/

//Food Endpoints
Route::get('foods', 'App\Http\Controllers\FoodController@getAllFoods');
Route::get('foods/{id}', 'App\Http\Controllers\FoodController@getFood');
Route::post('store_food', 'App\Http\Controllers\FoodController@addFood');
Route::get('delete_food/{id}', 'App\Http\Controllers\FoodController@deleteFood');
Route::put('update_food/{id}', 'App\Http\Controllers\FoodController@updateFood');

//Drink Endpoints
Route::get('drinks', 'App\Http\Controllers\DrinkController@getAllDrinks');
Route::get('drinks/{id}', 'App\Http\Controllers\DrinkController@getDrink');
Route::post('store_drink', 'App\Http\Controllers\DrinkController@addDrink');
Route::get('delete_drink/{id}', 'App\Http\Controllers\DrinkController@deleteDrink');
Route::put('update_drink/{id}', 'App\Http\Controllers\DrinkController@updateDrink');

//Customer Endpoints
Route::get('customers', 'App\Http\Controllers\CustomerController@getAllCustomers');
Route::get('customer/{email}', 'App\Http\Controllers\CustomerController@getCustomer');
Route::post('register', 'App\Http\Controllers\CustomerController@register');
Route::get('delete_customer/{id}', 'App\Http\Controllers\CustomerController@deleteCustomer');
Route::put('update_customer/{id}', 'App\Http\Controllers\CustomerController@updateCustomer');
Route::post('login', 'App\Http\Controllers\CustomerController@login');
Route::get('customers/store_order/{id}', 'App\Http\Controllers\CustomerController@addOrder');
Route::get('orders', 'App\Http\Controllers\OrderController@getOrders');
Route::get('orders/{id}', 'App\Http\Controllers\OrderController@getOrder');
Route::get('customers/orders/{id}', 'App\Http\Controllers\OrderController@getCustomerOrders');
Route::get('customers/order/{id}', 'App\Http\Controllers\OrderController@getCustomerOrder');
Route::get('customers/delete_order/{id}', 'App\Http\Controllers\OrderController@deleteOrder');
Route::put('customers/update_order/{id}', 'App\Http\Controllers\OrderController@updateOrder');




