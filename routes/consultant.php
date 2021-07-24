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

/*post Api's*/
route::get('/register','App\Http\Controllers\Api\ConsultantApiController@register');
route::get('/verifyOtp','App\Http\Controllers\Api\ConsultantApiController@verifyOtp');
route::get('/login','App\Http\Controllers\Api\ConsultantApiController@login');
route::get('updateProfile','App\Http\Controllers\Api\ConsultantApiController@updateProfile');
/* end post Api's */


// Route::post('login', 'PassportController@login');
// Route::post('register', 'PassportController@register');

//Route::middleware('auth:api')->group(function () {

route::get('/userList','App\Http\Controllers\Api\ConsultantApiController@userList');
route::get('/specialityList','App\Http\Controllers\Api\ConsultantApiController@specialityList');
route::get('/userInfo','App\Http\Controllers\Api\ConsultantApiController@userInfo');
route::get('/userBySpeciality','App\Http\Controllers\Api\ConsultantApiController@userBySpeciality');
// route::get('/profileInfo','App\Http\Controllers\Api\ConsultantApiController@login');


route::get('/booking','App\Http\Controllers\Api\ConsultantApiController@booking');

    // Route::get('user', 'PassportController@details');
    // Route::resource('products', 'ProductController');
//});
// ----list of post apis:---
// register
// login
// updateProfile
// bookings


// Route::get('mail', function () {
//     $details = [
//         'body' => 'Your Otp is: '
//     ];
//   \Mail::to('rasad6649@gmail.com')->send(new \App\Mail\otpMail($details));
// // dd("Email is Sent.");
// });
route::get('/deleteUser','App\Http\Controllers\Api\ConsultantApiController@deleteUser');
