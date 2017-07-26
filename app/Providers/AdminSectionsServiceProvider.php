<?php

namespace App\Providers;

use SleepingOwl\Admin\Providers\AdminSectionsServiceProvider as ServiceProvider;
use SleepingOwl\Admin\Navigation\Page;
use AdminSection;
use PackageManager;

class AdminSectionsServiceProvider extends ServiceProvider
{

    /**
     * @var array
     */
    protected $sections = [
        //Users
        \App\Models\Users\User::class => 'App\Http\Sections\Users\User',
        //Products
        \App\Models\Products\Category::class => 'App\Http\Sections\Products\Category',
        \App\Models\Products\Product::class => 'App\Http\Sections\Products\Product',
        \App\Models\Products\ProductPrice::class => 'App\Http\Sections\Products\ProductPrice',
        //Orders

        //Storage
        \App\Models\Storages\Storage::class => 'App\Http\Sections\Storages\Storage',

        //Landings
        \App\Models\land_1000i1potolok\DbLanding::class  => 'App\Http\Sections\Land1000i1Potolok\DbLandingSettings',
        \App\Models\land_1000i1potolok\DbFeedback::class  => 'App\Http\Sections\Land1000i1Potolok\DbFeedbackSettings'/*,
        \App\Models\land_1000i1potolok\DbSetting::class  => 'App\Http\Sections\Land1000i1Potolok\DbSettingSettings'*/
    ];

    /**
     * Register sections.
     *
     * @return void
     */
    public function boot(\SleepingOwl\Admin\Admin $admin)
    {
        //

        parent::boot($admin);
        
    /*    $this->register()->Routes();
        $this->registerNavigation();
        $this->registerMediaPackages();*/
    }
    
    private function registerNavigation()
    {
        \AdminNavigation::setFromArray([
            [
                'title' => trans('core.title.organisation'),
                'icon' => 'fa fa-group',
                'priority' => 1000,
                'pages' => [
                        (new Page(\App\Models\DbLanding::class))->setPriority(0)
                ]
            ]
        ]);
    }
    
    private function registerNRoutes()
    {
        $this->app['router']->group([
            'prefix' => config('sleeping_owl.url_prefix'),
            'middleware' => config('sleeping_owl.middleware')],
            function ($router) {
                $router->get('', ['as' => 'admin.dashboard', function () {
                    $content = 'Define your dashboard here2323.';
                    return AdminSection::view($content, 'Dashboard2');
                }]);
        });
    }
    
    private function registerMediaPackages()
    {
        PackageManager::add('front.controllers')
        ->js(null, asset('js/controllers.js'));
    }
}
