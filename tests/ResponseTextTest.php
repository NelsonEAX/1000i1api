<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ResponseTextTest extends TestCase
{
    /**
     * Тест главной страницы api
     */
    public function testApiMainPage()
    {
        $this->visit('/')
            ->see('api.1000i1.ru')
            ->see('s013.radikal.ru')
            ->see('cs6.pikabu.ru');
    }
    /**
     * Тест страницы авторизации
     */
    public function testApiLoginPage()
    {
        $this->visit('/login')
            ->see('api.1000i1.ru')
            ->see('id="email"')
            ->see('id="password"')
            ->see('Запомнить меня')
            ->see('Забыл пароль?');
    }
}
