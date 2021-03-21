<?php

use App\Http\Controllers\Admin\Car\CarController;
use App\Http\Controllers\Admin\User\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Home\HomeController;

Route::get('/register', [RegisterController::class, 'index'])->name('user@register_view');
Route::post('/register', [RegisterController::class, 'store_user'])->name('user@register_action');
Route::get('/admin/register', [RegisterController::class, 'index'])->name('admin@register_view');
Route::post('/admin/register', [RegisterController::class, 'store_admin'])->name('admin@register_action');
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');
Route::get('/dashboard/cars', [CarController::class, 'index'])->name('cars@dashboard');
Route::get('/dashboard/cars/add', [CarController::class, 'render_add_form'])->name('car_add');
Route::post('/dashboard/cars/add', [CarController::class, 'add']);
Route::get('/dashboard/cars/{car}/update', [CarController::class, 'render_update_form'])->name('car_update_view');
Route::post('/dashboard/cars/{id}/update', [CarController::class, 'update'])->name('car_update_action');
Route::delete('/dashboard/cars/{car}', [CarController::class, 'delete'])->name('car_delete');
Route::get('/dashboard/users', [UserController::class, 'index'])->name('users@dashboard');
Route::get('/dashboard/users/{user}/update', [UserController::class, 'render_update_form'])->name('user_update_view');
Route::post('/dashboard/users/{id}/update', [UserController::class, 'update'])->name('user_update_action');
Route::delete('/dashboard/users/{user}', [UserController::class, 'delete'])->name('user_delete');
Route::get('/dashboard/users/{user}/freeRents', [UserController::class, 'getUserFreeRents'])->name('user_free_rents');
Route::get('/dashboard/users/{user}/rents', [UserController::class, 'getUserRents'])->name('user_rents');
Route::get('/me/freeRents', [HomeController::class, 'getUserFreeRents'])->name('auth.user_free_rents');
Route::get('/me/rents', [HomeController::class, 'getUserRents'])->name('auth.user_rents');
Route::get('/platform.policies', [HomeController::class, 'showCarrentalPolicies'])->name('carrental.policies');
Route::post('/freeRent/{car}', [HomeController::class, 'freeRent'])->name('free_rent.proceed');
Route::post('/rent/{car}', [HomeController::class, 'rent'])->name('rent.proceed');
Route::resource('policies', HomeController::class);
Route::get('/rent/{car}/form', [HomeController::class, 'render_rent_form'])->name('rent_perform_view');
