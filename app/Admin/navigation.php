<?php

use SleepingOwl\Admin\Navigation\Page;
use SleepingOwl\Admin\Navigation\Badge;

return [
    (new Page())
        ->setPriority(1)
        ->setTitle('Главная')
        ->setIcon('fa fa-dashboard')
        ->setUrl( route('admin.dashboard') )
    ,
    (new Page())
        ->setPriority(100)
        ->setTitle('1000i1potolok.ru')
        ->setIcon('fa fa-columns')
        ->setPages(function (Page $page) {
            $page->addPage((new Page(\App\Models\land_1000i1potolok\DbLanding::class))
                ->setPriority(10)
                ->setTitle('Лендинги')
                ->setIcon('fa fa-caret-right')
                ->setUrl('admin/potolok/land')
                ->setBadge( new Badge( \App\Models\land_1000i1potolok\DbLanding::count()))
                ->setAccessLogic(function (Page $page) {
                    return true;
                })
            );
            $page->addPage((new Page(\App\Models\land_1000i1potolok\DbFeedback::class))
                ->setPriority(20)
                ->setTitle('Обратная связь')
                ->setIcon('fa fa-caret-right')
                ->setUrl('admin/potolok/feedback')
                ->setBadge( new Badge( \App\Models\land_1000i1potolok\DbFeedback::count()))
                ->setAccessLogic(function (Page $page) {
                    return true;
                })
            );
            /*$page->addPage(
               (new Page(\App\Models\land_1000i1potolok\DbSetting::class))
                  ->setPriority(10)
                  ->setTitle('Настройки')
                  ->setIcon('fa fa-caret-right')
                  ->setUrl('admin/potolok/settings')
                  ->setBadge( new Badge( \App\Models\land_1000i1potolok\DbSetting::count()))
                  ->setAccessLogic(function (Page $page) {
                     return true;
                  })
            );*/
        }),
    (new Page())
        ->setPriority(200)
        ->setTitle('Портал')
        ->setIcon('fa fa-object-group')
        ->setPages(function (Page $page) {
            $page->addPage((new Page())
                ->setPriority(10)
                ->setTitle('Пользователи')
                ->setIcon('fa fa-plus') /*fa-caret-right*/
                ->setPages(function (Page $page) {
                    $page->addPage((new Page(\App\Models\Users\User::class))
                        ->setPriority(10)
                        ->setTitle('Пользователи')
                        ->setIcon('fa fa-minus')
                        ->setUrl('admin/users/user')
                        ->setBadge( new Badge( \App\Models\Users\User::count()))
                        ->setAccessLogic(function (Page $page) {
                            return true;
                        })
                    );
                })
            );
            $page->addPage((new Page())
                ->setPriority(20)
                ->setTitle('Продукция')
                ->setIcon('fa fa-plus')
                ->setPages(function (Page $page) {
                    $page->addPage((new Page(\App\Models\Products\Category::class))
                        ->setPriority(10)
                        ->setTitle('Категории')
                        ->setIcon('fa fa-minus')
                        ->setUrl('admin/products/category')
                        ->setBadge( new Badge( \App\Models\Products\Category::count()))
                        ->setAccessLogic(function (Page $page) {
                            return true;
                        })
                    );
                    $page->addPage((new Page(\App\Models\Products\Product::class))
                        ->setPriority(20)
                        ->setTitle('Продукция')
                        ->setIcon('fa fa-minus')
                        ->setUrl('admin/products/product')
                        ->setBadge( new Badge( \App\Models\Products\Product::count()))
                        ->setAccessLogic(function (Page $page) {
                            return true;
                        })
                    );

                })
            );
            $page->addPage((new Page())
                ->setPriority(30)
                ->setTitle('Заказы')
                ->setIcon('fa fa-plus')
                ->setPages(function (Page $page) {
                    $page->addPage((new Page(\App\Models\Orders\Order::class))
                        ->setPriority(10)
                        ->setTitle('Заказы')
                        ->setIcon('fa fa-minus')
                        ->setUrl('admin')
                        ->setBadge( new Badge( \App\Models\Orders\Order::count()))
                        ->setAccessLogic(function (Page $page) {
                            return true;
                        })
                    );
                })
            );
            $page->addPage((new Page())
                ->setPriority(40)
                ->setTitle('Хранилище')
                ->setIcon('fa fa-archive')
                ->setPages(function (Page $page) {
                    $page->addPage((new Page(\App\Models\Storages\Storage::class))
                        ->setPriority(10)
                        ->setTitle('Изображения')
                        ->setIcon('fa fa-picture-o')
                        ->setUrl('admin/storages/storage')
                        ->setBadge( new Badge( \App\Models\Storages\Storage::count()))
                        ->setAccessLogic(function (Page $page) {
                            return true;
                        })
                    );
                })

            );
        }),



    (new Page())
        ->setPriority(1000)
        ->setTitle('Инфо')
        ->setIcon('fa fa-exclamation-circle')
        ->setUrl( route('admin.information') )
    ,
];