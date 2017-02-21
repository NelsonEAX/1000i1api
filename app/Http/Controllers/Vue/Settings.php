<?php

namespace App\Http\Controllers\Vue;
//namespace Laravel\Passport;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Laravel\Passport\Client;
//use

class Settings extends Controller
{
    private function return_host($url)
    {
        $url = str_replace(array('http://', 'https://'), '', $url);
        $temp = explode('/', $url); // explode the url by /
        if(strpos($temp[0], '.com')) { // check the url part
            return $temp[0];
        }
        else {
            return false;
        }
    }


    public function server()
    {
        /*prod*/
        $localhost = isset($_SERVER['HTTP_REFERER'])? $_SERVER['HTTP_REFERER'] : 'http://1000i1.ru';
        $localhost = parse_url($localhost, PHP_URL_HOST);
        $server = 'http://api.1000i1.ru';
        if (isset($_SERVER['HTTP_REFERER']))
        {
            switch($localhost){
                /*dev*/
                case 'localhost':
                    $server = 'http://1000i1api:88';
                    break;
                /*test*/
                case 'testvue.1000i1.ru':
                    $server = 'http://testapi.1000i1.ru';
                    break;
            }
        }

        return response()->json([
            'localhost' => $localhost,
            'server' => $server
        ]);
    }

    public function secret()
    {
        if(isset($_SERVER['HTTP_REFERER']))
        {
            $localhost = parse_url($_SERVER['HTTP_REFERER'], PHP_URL_HOST);
            $hosts = array(
                'localhost',
                'testvue.1000i1.ru',
                '1000i1.ru'
            );
            if (in_array($localhost, $hosts)) {
                return response()->json([
                    'secret' => Client::where('id', 2)->pluck('secret'),
                    'server' => $localhost
                ]);
            }
        }
        return response()->json([
            'secret' => 'zUfuckVzGz4erxyzj6PObTTw5ugmHMhRdtvKyouC',
            'server' => $localhost
        ]);
    }
}
