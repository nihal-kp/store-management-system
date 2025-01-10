<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register admin routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "admin" middleware group. Now create something great!
|
*/


Auth::routes(['register' => false]);

Route::get('/', 'HomeController@index')->name('home');
Route::get('reset-password', 'HomeController@changePassword')->name('reset-password');
Route::post('update-password', 'HomeController@updatePassword')->name('update-password');
Route::resource('settings', 'SettingsController');
Route::post('updateSettings', 'SettingsController@updateForm')->name('settings.updateSettings');
Route::resource('stores', 'StoreController');
Route::resource('customers', 'CustomerController');
// Route::resource('users', 'UserController');

Route::get('logout', 'Auth\LoginController@logout', function () {
    return abort(404);
});

View::Composer(['admin.partials._header', 'admin.partials._sidebar', 'admin.partials._footer', 'admin.layouts.app', 'admin.auth.login'], function ($view) {

    $view->with([
        //
    ]);
});