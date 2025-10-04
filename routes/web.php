<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home');

//rout to admin dashboard
Route::get('/admin/dashboard', [HomeController::class, 'dashboard'])->name('admin.dashboard');
Route::get('/admin/dashboard/{id}', [HomeController::class, 'getUser'])->name('admin.getuser');
//end rout to admin dashboard

Route::post('/pages/register', [HomeController::class, 'storeUser'])->name('pages/storeUser');
Route::get('pages/register', [HomeController::class, 'register'])->name('pages/register');
Route::get('layouts/headers/cards', [HomeController::class, 'getTotalUsers'])->name('users');
Route::get('/dashboard/{id}', [HomeController::class, 'getUser'])->name('dashboard.getuser');

Auth::routes();

Route::group(['middleware' => 'auth'], function () {
	Route::resource('user', 'App\Http\Controllers\UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
	    Route::get('registeredUsers', function () {return view('pages.registeredUsers');})->name('registeredUsers');
	    Route::get('registeredDrivers', function () {return view('pages.registeredDrivers');})->name('registeredDrivers');
	    Route::get('tripHistory', function () {return view('pages.tripHistory');})->name('tripHistory');
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);
});

