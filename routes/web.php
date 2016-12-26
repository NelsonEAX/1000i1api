<?php

use App\Models\DbLanding;
use Illuminate\Support\Facades\Auth;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

/*Route::get('/land', function () {
	$all = DbLanding::all();
	print_r($all);
});*/
Auth::routes();

Route::get('/home', 'HomeController@index');
Auth::routes();