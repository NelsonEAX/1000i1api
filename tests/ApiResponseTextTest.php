<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ApiResponseTextTest extends TestCase
{
    /** Тестовая страница api */
    public function testApiTestPage()
    {
        $this->visit('/api/test')
            ->see('{"user":{"name":"Nelson","subname":"EAX"}}');
    }

    /** Тест метода получения хоста */
    public function testApiSettingsServerPage()
    {
        $this->visit('/api/setting/vue/server')
            ->see('"localhost"')
            ->see('"server"');
    }

    /** Тест метода получения секретного ключа */
    public function testApiSettingsSecretPage()
    {
        $this->visit('/api/setting/vue/secret')
            ->see('"secret"')
            ->see('"zUfuckVzGz4erxyzj6PObTTw5ugmHMhRdtvKyouC"')
            ->see('"server"')
            ->see('"localhost"');
    }
}
