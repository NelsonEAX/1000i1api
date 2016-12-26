<?php

use SleepingOwl\Admin\Navigation\Page;
use SleepingOwl\Admin\Navigation\Badge;

// Default check access logic
// AdminNavigation::setAccessLogic(function(Page $page) {
// 	   return auth()->user()->isSuperAdmin();
// });
//
// AdminNavigation::addPage(\App\User::class)->setTitle('test')->setPages(function(Page $page) {
// 	  $page
//		  ->addPage()
//	  	  ->setTitle('Dashboard')
//		  ->setUrl(route('admin.dashboard'))
//		  ->setPriority(100);
//
//	  $page->addPage(\App\User::class);
// });
//
// // or
//
// AdminSection::addMenuPage(\App\User::class)

return [
	[
	'title' => '1000i1potolok.ru',
	'icon'  => 'fa fa-dashboard',
	//'badge' => new Badge( \App\Models\DbLanding::count()),
	'pages' => [

			(new Page(\App\Models\DbLanding::class))
			->setPriority(10)
			->setIcon('fa fa-user')
			->setTitle('Landing')
			->setUrl('admin/potolok/land')
			->setPriority(100)
			->setBadge( new Badge( \App\Models\DbLanding::count()))
			->setAccessLogic(function (Page $page) {
				return true;
			}),
			(new Page(\App\Models\DbFeedback::class))
			->setPriority(10)
			->setIcon('fa fa-user')
			->setTitle('FeedBack')
			->setUrl('admin/potolok/feedback')
			->setPriority(500)
			->setBadge( new Badge( \App\Models\DbFeedback::count()))
			->setAccessLogic(function (Page $page) {
				return true;
			}),
			(new Page(\App\Models\DbSetting::class))
			->setPriority(10)
			->setIcon('fa fa-user')
			->setTitle('Settings')
			->setUrl('admin/potolok/settings')
			->setPriority(200)
			//->setBadge( new Badge( \App\Models\DbSetting::count()))
			->setAccessLogic(function (Page $page) {
				return true;
			}),
		]
	],
		
    [
        'title' => 'Dashboard',
        'icon'  => 'fa fa-dashboard',
        'url'   => route('admin.dashboard'),
    ],

    [
        'title' => 'Information',
        'icon'  => 'fa fa-exclamation-circle',
        'url'   => route('admin.information'),
    ],
	
    // Examples
    // [
    //    'title' => 'Content',
    //    'pages' => [
    //
    //        \App\User::class,
    //
    //        // or
    //
    //        (new Page(\App\User::class))
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
	//		      ));
    //
	//		      $page->addPage(\App\Blog::class);
    //	      }),
    //
    //        // or
    //
    //        [
    //            'title'       => 'News',
    //            'priority'    => 300,
    //            'accessLogic' => function ($page) {
    //                return $page->isActive();
    //		      },
    //            'pages'       => [
    //
    //                // ...
    //
    //            ]
    //        ]
    //    ]
    // ]
];