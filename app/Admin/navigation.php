<?php

use SleepingOwl\Admin\Navigation\Page;
use SleepingOwl\Admin\Navigation\Badge;

// Default check access logic
// AdminNavigation::setAccessLogic(function(Page $page) {
//       return auth()->user()->isSuperAdmin();
// });
//
// AdminNavigation::addPage(\App\Models\Users\User::class)->setTitle('test')->setPages(function(Page $page) {
//      $page
//      ->addPage()
//      ->setTitle('Dashboard')
//      ->setUrl(route('admin.dashboard'))
//      ->setPriority(100);
//
//   $page->addPage(\App\Models\Users\User::class);
// });
//
// // or
//
// AdminSection::addMenuPage(\App\Models\Users\User::class)

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
         $page->addPage(
            (new Page(\App\Models\land_1000i1potolok\DbLanding::class))
               ->setPriority(10)
               ->setTitle('Лендинги')
               ->setIcon('fa fa-caret-right')
               ->setUrl('admin/potolok/land')
               ->setBadge( new Badge( \App\Models\land_1000i1potolok\DbLanding::count()))
               ->setAccessLogic(function (Page $page) {
                  return true;
               })
         );
         $page->addPage(
            (new Page(\App\Models\land_1000i1potolok\DbFeedback::class))
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
      ->setTitle('1000i1.ru')
      ->setIcon('fa fa-object-group')
      ->setPages(function (Page $page) {
         $page->addPage(
            (new Page(\App\Models\land_1000i1potolok\DbLanding::class))
               ->setPriority(1)
               ->setTitle('Лендинги')
               ->setIcon('fa fa-caret-right')
               ->setUrl('admin/potolok/land')
               ->setBadge( new Badge( \App\Models\land_1000i1potolok\DbLanding::count()))
               ->setAccessLogic(function (Page $page) {
                  return true;
               })
         );
         $page->addPage(
            (new Page(\App\Models\land_1000i1potolok\DbFeedback::class))
               ->setPriority(2)
               ->setTitle('Обратная связь')
               ->setIcon('fa fa-caret-right')
               ->setUrl('admin/potolok/feedback')
               ->setBadge( new Badge( \App\Models\land_1000i1potolok\DbFeedback::count()))
               ->setAccessLogic(function (Page $page) {
                  return true;
               })
         );
         $page->addPage(
            (new Page(\App\Models\land_1000i1potolok\DbSetting::class))
               ->setPriority(10)
               ->setTitle('Настройки')
               ->setIcon('fa fa-caret-right')
               ->setUrl('admin/potolok/settings')
               //->setBadge( new Badge( \App\Models\land_1000i1potolok\DbSetting::count()))
               ->setAccessLogic(function (Page $page) {
                  return true;
               })
         );
      }),



   (new Page())
      ->setPriority(1000)
      ->setTitle('Инфо')
      ->setIcon('fa fa-exclamation-circle')
      ->setUrl( route('admin.information') )
   ,
/*   [
   'title' => '1000i1potolok.ru',
   'icon'  => 'fa fa-dashboard',
   //'badge' => new Badge( \App\Models\DbLanding::count()),
   'pages' => [

         (new Page(\App\Models\land_1000i1potolok\DbLanding::class))
         ->setPriority(10)
         ->setIcon('fa fa-user')
         ->setTitle('Лендинги')
         ->setUrl('admin/potolok/land')
         ->setPriority(100)
         ->setBadge( new Badge( \App\Models\land_1000i1potolok\DbLanding::count()))
         ->setAccessLogic(function (Page $page) {
            return true;
         }),
         (new Page(\App\Models\land_1000i1potolok\DbFeedback::class))
         ->setPriority(10)
         ->setIcon('fa fa-user')
         ->setTitle('Обратная связь')
         ->setUrl('admin/potolok/feedback')
         ->setPriority(500)
         ->setBadge( new Badge( \App\Models\land_1000i1potolok\DbFeedback::count()))
         ->setAccessLogic(function (Page $page) {
            return true;
         }),
         (new Page(\App\Models\land_1000i1potolok\DbSetting::class))
         ->setPriority(10)
         ->setIcon('fa fa-user')
         ->setTitle('Настройки')
         ->setUrl('admin/potolok/settings')
         ->setPriority(200)
         //->setBadge( new Badge( \App\Models\DbSetting::count()))
         ->setAccessLogic(function (Page $page) {
            return true;
         }),
      ]
   ],

   [
      'title' => 'Главная',
      'icon'  => 'fa fa-dashboard',
      'url'   => route('admin.dashboard'),
      'Priority' => 1,
   ],

   (new Page(\App\Models\land_1000i1potolok\DbFeedback::class))
      ->setPriority(2)
      ->setIcon('fa fa-users')
      ->setTitle('Контрагенты')
      ->setUrl('admin/users')
      //->setBadge( new Badge( \App\Models\Users\User::count()))
      ->setAccessLogic(function (Page $page) {
         return true;
      }),


    [
        'title' => 'Инфо',
        'icon'  => 'fa fa-exclamation-circle',
        'url'   => route('admin.information'),
        'Priority' => 1000,
    ],
   */
    // Examples
    // [
    //    'title' => 'Content',
    //    'pages' => [
    //
    //        \App\Models\Users\User::class,
    //
    //        // or
    //
    //        (new Page(\App\Models\Users\User::class))
    //            ->setPriority(100)
    //            ->setIcon('fa fa-user')
    //            ->setUrl('users')
    //            ->setAccessLogic(function (Page $page) {
    //                return auth()->user()->isSuperAdmin();
    //            }),
    //
    //        // or
    //
    //        new Page([
    //            'title'    => 'News',
    //            'priority' => 200,
    //            'model'    => \App\News::class
    //        ]),
    //
    //        // or
    //        (new Page(/* ... */))->setPages(function (Page $page) {
    //            $page->addPage([
    //                'title'    => 'Blog',
    //                'priority' => 100,
    //                'model'    => \App\Blog::class
   //            ));
    //
   //            $page->addPage(\App\Blog::class);
    //         }),
    //
    //        // or
    //
    //        [
    //            'title'       => 'News',
    //            'priority'    => 300,
    //            'accessLogic' => function ($page) {
    //                return $page->isActive();
    //            },
    //            'pages'       => [
    //
    //                // ...
    //
    //            ]
    //        ]
    //    ]
    // ]
];