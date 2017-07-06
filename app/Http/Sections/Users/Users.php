<?php

namespace App\Http\Sections\Users;

use SleepingOwl\Admin\Contracts\DisplayInterface;
use SleepingOwl\Admin\Contracts\FormInterface;
use SleepingOwl\Admin\Section;

use AdminColumn;
use AdminColumnEditable;
use AdminDisplay;
use AdminForm;
use AdminFormElement;
use SleepingOwl\Admin\Contracts\Initializable;

class Users extends Section implements Initializable
{
    protected $model = '\App\Models\Users\User';
    /**
     * @var bool
     */
    protected $checkAccess = false;

    /**
     * @var string
     */
    protected $title = 'Контрагенты';

    /**
     * @var string
     */
    protected $alias = 'users/user';

    /**
     * @return DisplayInterface
     */
    public function onDisplay()
    {
        $rights_classes = 'bg-purple text-center';
        $rights1 = AdminColumn::custom()->setLabel('Админ')->setCallback(function (\App\Models\Users\User $user) {
            return $user->is_admin ? '<i class="fa fa-check"></i>' : '';
        })->setOrderable(false)
            ->setWidth('50px')
            ->setHtmlAttribute('class', 'text-center');
        $rights2 = AdminColumnEditable::checkbox('is_private')
            ->setLabel('Физ.Лицо')
            ->setWidth('50px')
            ->setHtmlAttribute('class', 'text-center');
        $rights3 = AdminColumnEditable::checkbox('is_legal')
            ->setLabel('Юр.Лицо')
            ->setWidth('50px')
            ->setHtmlAttribute('class', 'text-center');
        $rights4 = AdminColumnEditable::checkbox('is_confirmed')
            ->setLabel('Подтвержден')
            ->setWidth('50px')
            ->setHtmlAttribute('class', 'text-center');

        $rights1->getHeader()->setHtmlAttribute('class', $rights_classes)->setOrderable(false);
        $rights2->getHeader()->setHtmlAttribute('class', $rights_classes)->setOrderable(false);
        $rights3->getHeader()->setHtmlAttribute('class', $rights_classes)->setOrderable(false);
        $rights4->getHeader()->setHtmlAttribute('class', $rights_classes)->setOrderable(false);


        return AdminDisplay::datatables()/*->with('users')*/
        ->setHtmlAttribute('class', 'table-primary')
            ->setColumns(
                AdminColumn::text('id', '#')->setWidth('150px'),
                AdminColumn::text('lastname', 'Фамилия')->setWidth('10px'),
                AdminColumn::text('name', 'Имя')->setWidth('150px'),
                AdminColumn::text('email', 'Email')->setWidth('50px'),
                AdminColumn::text('phone', 'Тел.')->setWidth('50px'),
                $rights1,
                $rights2,
                $rights3,
                $rights4
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
            $form = AdminForm::panel();
            $form->addHeader(AdminFormElement::columns()
                ->addColumn([
                    AdminFormElement::text('lastname', 'Фамилия')
                        ->required()
                ], 4)
                ->addColumn([
                    AdminFormElement::text('name', 'Имя')
                        ->required()
                ], 4)
                ->addColumn([
                    AdminFormElement::text('middlename', 'Отчество')
                        ->required()
                ], 4)
            );
            $form->addBody([
                AdminFormElement::columns()
                    ->addColumn([
                        AdminFormElement::text('login', 'Логин')
                            ->required()
                            ->addValidationRule('unique:users,login,'.$id, 'Этот Логин уже занят, пробуй еще!')
                            ->addValidationRule('alpha_dash', 'Логин должен состоять из букв латинского алфавита и цифр'),
                    ], 4)
                    ->addColumn([
                        AdminFormElement::text('email', 'Емайл')
                            ->required()
                            ->addValidationRule('unique:users,email,'.$id, 'Этот электронный адрес уже занят, пробуй еще!')
                            ->addValidationRule('email', 'Электронный адрес должен иметь вид: example@mail.ru'),
                    ], 4)
                    ->addColumn([
                        AdminFormElement::text('phone', 'Телефон')
                            ->required()
                            ->addValidationRule('unique:users,phone,'.$id, 'Этот номер телефона уже занят, пробуй еще!')
                            ->addValidationRule('regex:/^\+7\d*$/', 'Номер телефона должен иметь вид: +79876543210'),
                    ], 4),
                AdminFormElement::columns()
                    ->addColumn([
                        AdminFormElement::date('birthday', 'Дата рождения')->setFormat('Y-m-d')->required(),
                        AdminFormElement::textarea('comment', 'Комментарий'),
                    ], 8)
                    ->addColumn([
                        AdminFormElement::image('photo', 'Photo')->addValidationRule('image', 'Необходимо выбрать изображение'),
                    ], 4),
            ]);
            $form->addFooter([
                AdminFormElement::columns()
                    ->addColumn([
                        AdminFormElement::checkbox('is_admin', 'Админ')
                    ], 3)
                    ->addColumn([
                        AdminFormElement::checkbox('is_private', 'Физ.Лицо')
                    ], 3)
                    ->addColumn([
                        AdminFormElement::checkbox('is_legal', 'Юр.Лицо')
                    ], 3)
                    ->addColumn([
                        AdminFormElement::checkbox('is_confirmed', 'Подтвержден')
                    ], 3)
            ]);
            $tabs[] = AdminDisplay::tab($form)->setLabel('Карточка контрагента')->setActive(true)->setIcon('<i class="fa fa-id-card-o"></i>');
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
        /*$display = AdminDisplay::tabbed();
        $display->setTabs(function(){
            $tabs = [];
            $form = AdminForm::panel();
            $form->addHeader(AdminFormElement::columns()
                ->addColumn([
                    AdminFormElement::text('lastname', 'Фамилия')
                        ->required()
                ], 4)
                ->addColumn([
                    AdminFormElement::text('name', 'Имя')
                        ->required()
                ], 4)
                ->addColumn([
                    AdminFormElement::text('middlename', 'Отчество')
                        ->required()
                ], 4)
            );
            $form->addBody([
                AdminFormElement::columns()
                    ->addColumn([
                        AdminFormElement::text('login', 'Логин')
                            ->required()
                            ->addValidationRule('unique:users,login', 'Этот Логин уже занят, пробуй еще!')
                            ->addValidationRule('alpha_dash', 'Логин должен состоять из букв латинского алфавита и цифр'),
                    ], 4)
                    ->addColumn([
                        AdminFormElement::text('email', 'Емайл')
                            ->required()
                            ->addValidationRule('unique:users,email', 'Этот электронный адрес уже занят, пробуй еще!')
                            ->addValidationRule('email', 'Электронный адрес должен иметь вид: example@mail.ru'),
                    ], 4)
                    ->addColumn([
                        AdminFormElement::text('phone', 'Телефон')->required()
                            ->addValidationRule('unique:users,phone', 'Этот номер телефона уже занят, пробуй еще!')
                            ->addValidationRule('regex:/^\d*$/', 'Номер телефона должен иметь вид: +79876543210'),
                    ], 4),
                AdminFormElement::columns()
                    ->addColumn([
                        AdminFormElement::date('birthday', 'Дата рождения')->setFormat('Y-m-d')->required(),
                        AdminFormElement::textarea('comment', 'Комментарий'),
                    ], 8)
                    ->addColumn([
                        AdminFormElement::image('photo', 'Photo')->addValidationRule('image', 'Необходимо выбрать изображение'),
                    ], 4),
            ]);
            $form->addFooter([
                AdminFormElement::columns()
                    ->addColumn([
                        AdminFormElement::checkbox('is_admin', 'Админ')
                    ], 3)
                    ->addColumn([
                        AdminFormElement::checkbox('is_private', 'Физ.Лицо')
                    ], 3)
                    ->addColumn([
                        AdminFormElement::checkbox('is_legal', 'Юр.Лицо')
                    ], 3)
                    ->addColumn([
                        AdminFormElement::checkbox('is_confirmed', 'Подтвержден')
                    ], 3)
            ]);
            $tabs[] = AdminDisplay::tab($form)->setLabel('Карточка контрагента')->setActive(true)->setIcon('<i class="fa fa-id-card-o"></i>');
            return $tabs;
        });
        return $display;*/
    }

    /**
     * @return void
     */
    public function onDelete($id)
    {
        // todo: remove if unused
    }

    /**
     * @return void
     */
    public function onRestore($id)
    {
        // todo: remove if unused
    }

    /**
     * Initialize class.
     */
    public function initialize()
    {
        // TODO: Implement initialize() method.
    }
}
