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

/*Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');*/
if (\App::environment() !== 'production') {

    Route::get('/test', function () {

        //Storage::disk('storage')->put('orders/zakaz.txt', 'Contents');
        return response()->json([
            'user' => [
                'name' => 'Nelson',
                'subname' => 'EAX'
            ]
        ]);
    });
    Route::get('/test/clear', function () {

        \App\Models\Users\User::where('email', '=', 'email@test.ru')->delete();
        //Storage::disk('storage')->put('orders/zakaz.txt', 'Contents');
        return response()->json([
            'user' => [
                'name' => 'Nelson',
                'subname' => 'EAX'
            ]
        ]);
    });
    Route::get('/test2', 'ProductController@index');

    Route::get('categories','ProductController@categories');
    Route::get('products','ProductController@products');
    /*$users = DB::table('users')
        ->leftJoin('posts', 'users.id', '=', 'posts.user_id')
        ->get();*/
    
}


Route::post('/register', 'Auth\RegisterController@apiRegister');
Route::get('/register/confirm/{token}', 'Auth\RegisterController@apiConfirm');
Route::get('/setting/vue/server', 'Vue\SettingsController@server');
Route::get('/setting/vue/secret', 'Vue\SettingsController@secret');

/** Выдача изображений и их искизов */
Route::get('/image/{dir}/{filename}{params}', 'StorageController@getImageFromParam')
    ->where([
        //'dir' => 'users|orders|products|categories',
        'filename' => '[0-9A-Fa-f]{8}\-[0-9A-Fa-f]{4}\-[0-9A-Fa-f]{4}\-[0-9A-Fa-f]{4}\-[0-9A-Fa-f]{12}',
        'params' => '(th\d{1,5}x\d{1,5})?\.[a-zA-Z0-9]{1,10}'
    ]);;


Route::group(['middleware' => 'auth:api'], function(){
    Route::get('/user', 'UserController@getInfo');
   // Route::resource('products','ProductController');
});
