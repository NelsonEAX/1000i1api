<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AdminResponseTextTest extends TestCase
{
    /** Тест главной страницы api-сервера */
    public function testAdminMainPage()
    {
        $this->visit('/')
            ->see('api.1000i1.ru')
            ->see('s013.radikal.ru')
            ->see('cs6.pikabu.ru');
    }

    /** Тест страницы авторизации */
    public function testAdminLoginPage()
    {
        $this->visit('/login')
            ->see('api.1000i1.ru')
            ->see('id="email"')
            ->see('id="password"')
            ->see('Запомнить меня')
            ->see('Забыл пароль?');
    }
}
