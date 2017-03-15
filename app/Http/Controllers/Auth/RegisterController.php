<?php

namespace App\Http\Controllers\Auth;

use DB;
//use Mail;
use Validator;
use App\User;
use App\Mail\EmailVerification;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Mail\Mailer;
use Laravel\Passport\Http\Controllers\AccessTokenController;
use Psr\Http\Message\ServerRequestInterface;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'email_token' => str_random(10),
        ]);
    }

    public function apiRegister(Request $request,
                                Mailer $mailer,                     //Верификация
                                ServerRequestInterface $request2,   //Получение токена
                                AccessTokenController $token        //Получение токена
    )
    {
        $data = $request->all();
        $validator = $this->validator($data);
        if($validator->fails())
        {
            return response()->json([
                'state' => false,
                'error' => $validator->messages()
            ]);
        }
       
        DB::beginTransaction();
        try
        {
            $user = $this->create($data);
            $mailer
                ->to($user->email)
                ->send(new EmailVerification($user));
            DB::commit();

            //Авторизуем сразу
            return $token->issueToken($request2);
            /*return response()->json([
                'state' => true,
                'user' => $user,
            ]);*/
        }
        catch(Exception $e)
        {
            DB::rollback(); 
            return  response()->json([
                'state' => false,
                'error' => 'В процессе регистрации возникли проблемы',
            ]);
        }
    }
    
    public function apiConfirm($token){
        try{
            $user = User::where('email_token',$token)->first();
            if($user){
                $user->setConfirm();
                return response()->json([
                    'state' => true,
                    'confirm' => true,
                    'user' => $user,
                ]);
            }else{
                return response()->json([
                    'state' => false,
                    'error' => 'Эта ссылка уже не действительна',
                ]);
            }
        }
        catch(\Exception $e){
            // catch code
        }
    }
}
