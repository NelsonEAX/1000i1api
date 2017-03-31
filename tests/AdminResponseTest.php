<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AdminResponseTest extends TestCase
{
    /** Тест админки */
    public function testAdminPanel()
    {
        //Авторизуемся
        $this->visit('/login');
        $this->type('nelsoneax@yandex.ru', 'email');
        $this->type('abc123d4', 'password');
        $this->press('Войти');
        $this->seePageIs('/admin');

        //Проверям Элементы на странице
        $this->see('"http://localhost/admin"')
            ->see('"http://localhost/admin/users"')
            ->see('"http://localhost/admin/potolok/land"')
            ->see('"http://localhost/admin/potolok/settings"')
            ->see('"http://localhost/admin/potolok/feedback"');

        //Проверяем раздел Контрагенты
        $this->visit('/admin/users');
        $this->seePageIs('/admin/users');
        $this->see('9826892066')
            ->see('"http://localhost/admin/users/create"');
        $this->visit('/admin/users/create');
        $this->seePageIs('/admin/users/create');
        $this->see('Создание документа в разделе Контрагенты')
            ->see('Карточка контрагента')
            ->see('id="lastname"')
            ->see('id="name"')
            ->see('id="middlename"')
            ->see('id="login"')
            ->see('id="email"')
            ->see('id="phone"')
            ->see('id="birthday"')
            ->see('name="comment"')
            ->see('name="is_admin"')
            ->see('name="is_private"')
            ->see('name="is_legal"')
            ->see('name="is_confirmed"');

        //Проверяем раздел Контрагенты
        $this->visit('/admin/potolok/land');
        $this->seePageIs('/admin/potolok/land');
        $this->see('1000i1potolok | Лендинги')
            ->see('"http://localhost/admin/potolok/land/create"');
       /* $this->visit('/admin/potolok/land/create');
        $this->seePageIs('/admin/potolok/land/create');
        $this->see('Создание документа в разделе 1000i1potolok | Лендинги')
            ->see('id="land_pref"')
            ->see('id="land_adres"')
            ->see('id="land_ya_verif"')
            ->see('id="land_go_verif"')
            ->see('id="land_post"')
            ->see('id="land_geo"')
            ->see('id="land_desc_satin"')
            ->see('id="land_desc_glossy"')
            ->see('id="land_desc_matt"')
            ->see('id="land_desc_multi"')
            ->see('id="land_desc_photo"')
            ->see('id="land_desc_carved"')
            ->see('id="land_desc_tissue"');*/

        //Пробуем зайти на страницу авторизации
        $this->visit('/login');
        $this->seePageIs('/home')
            ->see('Ты уже авторизован!');
    }

}
