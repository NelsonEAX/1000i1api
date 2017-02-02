<?php

use Illuminate\Http\Request;

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

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

Route::get('/test', function(){
   return response()->json([
      'user' => [
          'name' => 'Nelson',
          'subname' => 'EAX'
      ]
   ]);
});

Route::post('/register', 'Auth\RegisterController@apiRegister');
Route::get('/register/confirm/{token}', 'Auth\RegisterController@apiConfirm'); 

Route::group(['middleware' => 'auth:api'], function(){
    Route::resource('products','ProductsController');
});
