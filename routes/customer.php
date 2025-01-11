<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Auth::routes();
Route::get('logout', 'Auth\LoginController@logout', function () {
    return abort(404);
});
Route::post('loginWithOtp', 'Auth\LoginController@loginWithOtp')->name('loginWithOtp');
Route::get('customer/loginCheck', 'CustomerController@loginCheck')->name('loginCheck');
Route::post('otpVerify', 'Auth\LoginController@otpVerify')->name('otpVerify');
Route::post('resendOtp', 'Auth\LoginController@resendOTP')->name('resendOtp');
Route::get('account-under-verification', 'Auth\LoginController@underVerification')->name('account-under-verification');

// Route::get('index', function () {
//     return redirect('/');
// });
Route::middleware(['auth:customer', 'auth.session:customer', 'checkStatus:customer'])->group(function () {
    Route::get('/', 'HomeController@index')->name('welcome');
    Route::view('settings', 'settings')->name('settings');
    Route::put('account/{id}/update_password','CustomerController@updatePassword')->name('account.updatePassword');
    
});

View::Composer(['auth.login'], function($view){
    $view->with([
        //
    ]);
});