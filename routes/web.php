<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;

// Route::get('/', function () {
//     return view('welcome');
// });
// Route::get('admin', 'Auth\LoginController@showLoginForm');

//clear cache
Route::get('clear',function(){
    Artisan::call('config:cache');
    Artisan::call('cache:clear');
      return 'cache and config cleared!';
});

Route::get('/', function () {
   return redirect('/admin/login');
});
Route::group(['prefix' => 'admin'], function() {
    Route::auth();
});
// Auth::routes();
Route::get('register',function(){ return 'Registration not allowed';})->name('register');

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// Auth::routes();

Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function () {
	Route::resource('user', 'App\Http\Controllers\UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
	Route::get('upgrade', function () {return view('pages.upgrade');})->name('upgrade');
	 Route::get('map', function () {return view('pages.maps');})->name('map');
	 Route::get('icons', function () {return view('pages.icons');})->name('icons');
//	 Route::get('consultants', function () {return view('pages.consultants');})->name('consultants');
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);
});

Route::get('temp',function(){
return view('pages.temp');
});


//abdul admin side routes
Route::resource('consultant', 'App\Http\Controllers\ConsultantController');
Route::post('consultant/{id}', 'App\Http\Controllers\ConsultantController@update')->name('updateOverride');
