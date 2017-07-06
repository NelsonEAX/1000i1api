<?php

namespace App\Http\Sections\Products;

use SleepingOwl\Admin\Contracts\Display\DisplayInterface;
use SleepingOwl\Admin\Contracts\Form\FormInterface;
use SleepingOwl\Admin\Section;

use AdminColumn;
use AdminDisplay;
use AdminForm;
use AdminFormElement;
use SleepingOwl\Admin\Contracts\Initializable;

//use \App\Models\Products\Category;
/**
 * Class Product
 *
 * @property \App\Models\Products\Product $model
 *
 * @see http://sleepingowladmin.ru/docs/model_configuration_section
 */
class Product extends Section
{
    protected $model = '\App\Models\Products\Product';
    /**
     * @see http://sleepingowladmin.ru/docs/model_configuration#ограничение-прав-доступа
     *
     * @var bool
     */
    protected $checkAccess = false;

    /**
     * @var string
     */
    protected $title = 'Продукция';

    /**
     * @var string
     */
    protected $alias = 'products/product';

    /**
     * @return DisplayInterface
     */
    public function onDisplay()
    {
        return AdminDisplay::datatables()/*->with('users')*/
        ->setHtmlAttribute('class', 'table-primary')
            ->setColumns(
                AdminColumn::text('id', '#')->setWidth('10px'),
                AdminColumn::text('name', 'Название'),
                // todo:сделать редактирование по месту
                AdminColumn::text('order', 'Порядок')->setWidth('10px'),
                AdminColumn::text('enable', 'Активность')->setWidth('10px')
            )->paginate(20);
    }

    /**
     * @param int $id
     *
     * @return FormInterface
     */
    public function onEdit($id)
    {
        $display = AdminDisplay::tabbed();
        $display->setTabs(function() use ($id) {
            $tabs = [];
            $main = AdminForm::panel();
            $price = AdminForm::panel();
            $main->addHeader(AdminFormElement::columns()
                ->addColumn([
                        AdminFormElement::text('name', 'Название')->required()
                            ->addValidationRule('unique:products,name,'.$id, 'Это Название уже занято, пробуй еще!')
                    ], 8)
                ->addColumn([
                        AdminFormElement::number('order', 'Порядок')->required()
                            ->setDefaultValue(100)
                            ->setMin(0)
                            ->setMax(999)
                    ], 2)
                ->addColumn([
                        AdminFormElement::checkbox('enable', 'Активность')->required()
                    ], 2)
            );
            $main->addBody([
                AdminFormElement::columns()->addColumn([
                    AdminFormElement::select('id', 'Categories', \App\Models\Products\Category::class)->setDisplay('name'),
                ], 4)

               /* AdminFormElement::columns()->addColumn([
                    AdminFormElement::text('login', 'Логин')->required()
                        ->addValidationRule('unique:users,login,'.$id, 'Этот Логин уже занят, пробуй еще!')
                        ->addValidationRule('alpha_dash', 'Логин должен состоять из букв латинского алфавита и цифр'),
                ], 4)->addColumn([
                    AdminFormElement::text('email', 'Емайл')->required()
                        ->addValidationRule('unique:users,email,'.$id, 'Этот электронный адрес уже занят, пробуй еще!')
                        ->addValidationRule('email', 'Электронный адрес должен иметь вид: example@mail.ru'),
                ], 4)->addColumn([
                    AdminFormElement::text('phone', 'Телефон')->required()
                        ->addValidationRule('unique:users,phone,'.$id, 'Этот номер телефона уже занят, пробуй еще!')
                        ->addValidationRule('regex:/^\+7\d*$/', 'Номер телефона должен иметь вид: +79876543210'),
                ], 4),
                AdminFormElement::columns()->addColumn([
                    AdminFormElement::date('birthday', 'Дата рождения')->setFormat('Y-m-d')->required(),
                    AdminFormElement::textarea('comment', 'Комментарий'),
                ], 8)->addColumn([
                    AdminFormElement::image('photo', 'Photo')->addValidationRule('image', 'Необходимо выбрать изображение'),
                ], 4),*/
            ]);
            $main->addFooter([
                /*AdminFormElement::columns()
                    ->addColumn([
                        AdminFormElement::checkbox('is_admin', 'Админ')
                    ], 3)->addColumn([
                        AdminFormElement::checkbox('is_private', 'Физ.Лицо')
                    ], 3)->addColumn([
                        AdminFormElement::checkbox('is_legal', 'Юр.Лицо')
                    ], 3)->addColumn([
                        AdminFormElement::checkbox('is_confirmed', 'Подтвержден')
                    ], 3)*/
            ]);

            $price->addHeader(AdminFormElement::columns()/*
                ->addColumn([
                    AdminFormElement::text('name', 'Название')->required()
                        ->addValidationRule('unique:products,name,'.$id, 'Это Название уже занято, пробуй еще!')
                ], 8)->addColumn([
                    AdminFormElement::number('order', 'Порядок')->required()
                        ->setDefaultValue(100)
                        ->setMin(0)
                        ->setMax(999)
                ], 2)->addColumn([
                    AdminFormElement::checkbox('enable', 'Активность')->required()
                ], 2)*/
            );
            $price->addBody([
                /*AdminFormElement::columns()->addColumn([
                    AdminFormElement::text('login', 'Логин')->required()
                        ->addValidationRule('unique:users,login,'.$id, 'Этот Логин уже занят, пробуй еще!')
                        ->addValidationRule('alpha_dash', 'Логин должен состоять из букв латинского алфавита и цифр'),
                ], 4)->addColumn([
                    AdminFormElement::text('email', 'Емайл')->required()
                        ->addValidationRule('unique:users,email,'.$id, 'Этот электронный адрес уже занят, пробуй еще!')
                        ->addValidationRule('email', 'Электронный адрес должен иметь вид: example@mail.ru'),
                ], 4)->addColumn([
                    AdminFormElement::text('phone', 'Телефон')->required()
                        ->addValidationRule('unique:users,phone,'.$id, 'Этот номер телефона уже занят, пробуй еще!')
                        ->addValidationRule('regex:/^\+7\d*$/', 'Номер телефона должен иметь вид: +79876543210'),
                ], 4),
                AdminFormElement::columns()->addColumn([
                    AdminFormElement::date('birthday', 'Дата рождения')->setFormat('Y-m-d')->required(),
                    AdminFormElement::textarea('comment', 'Комментарий'),
                ], 8)->addColumn([
                    AdminFormElement::image('photo', 'Photo')->addValidationRule('image', 'Необходимо выбрать изображение'),
                ], 4),*/
            ]);

            array_push($tabs, AdminDisplay::tab($main)->setLabel('Характеристики')->setActive(true)->setIcon('<i class="fa fa-id-card-o"></i>'));
            array_push($tabs, AdminDisplay::tab($price)->setLabel('Цены')->setActive(false)->setIcon('<i class="fa fa-rub"></i>'));
            return $tabs;
        });
        return $display;
    }

    /**
     * @return FormInterface
     */
    public function onCreate()
    {
        return $this->onEdit(null);
    }

    /**
     * @return void
     */
    /*public function onDelete($id)
    {
        // todo: remove if unused
    }*/

    /**
     * @return void
     */
    /*public function onRestore($id)
    {
        // todo: remove if unused
    }*/
}
