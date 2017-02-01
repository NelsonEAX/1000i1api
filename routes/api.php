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

Route::group(['middleware' => ['web','guest']], function () {
    Route::get('/csrf', function () {
        return response()->json([
            'csrf' => csrf_token()
        ]);
    });
});


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

Route::group(['middleware' => 'auth:api'], function(){
    
    
    
    
    Route::resource('products','ProductsController@index');
});
