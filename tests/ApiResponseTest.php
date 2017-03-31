<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ApiResponseTest extends TestCase
{
    /** Тест авторизации через api */
    public function testApiGetToken()
    {
        $response = $this->action('GET',
            '\Laravel\Passport\Http\Controllers\AccessTokenController@issueToken',
            array(
                'client_id' => 2,
                'client_secret' => 'zUxRqZVzGz4erCWkj6PObTTw5ugmHMhRdtvKWSiC',
                'grant_type' => 'password',
                'username' => 'nelsoneax@yandex.ru',
                'password' => 'abc123d4',

            )
        );
//        print_r($response);
    }
}
