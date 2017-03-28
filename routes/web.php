<?php

use App\Models\DbLanding;
use App\Mail\EmailVerification;
use App\Models\Users\User;
use Illuminate\Support\Facades\Auth;
//use Mail;
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


Route::get('/mail', function (Illuminate\Mail\Mailer $mailer) {
    /*Mail::send('emails.confirmation', array('key' => 'value'), function($message)
    {
        $message->to('foo@example.com', 'Джон Смит')->subject('Подтверждение электронной почты!');
    });*/
    $mailer
        ->to('sdfafd@dfgdfh.ru')
        ->send(new EmailVerification(new User(['email_token' => 'fbdfbfffffff'])));
    return 'ok';
});

/*Route::get('/land', function () {
	$all = DbLanding::all();
	print_r($all);
});*/
/*Auth::routes();*/

Route::get('/home', 'HomeController@index');
Auth::routes();