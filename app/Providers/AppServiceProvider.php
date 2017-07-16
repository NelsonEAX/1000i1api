<?php

namespace App\Providers;

use Event;
use App\Events\DeleteFromStorageEvent;
use App\Models\Products\Product;
use App\Models\Products\Category;
use App\Models\Orders\Order;
use App\Models\Users\User;
use App\Models\Storages\Storage;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //При удалении записи хранилища - стреляем событие удаления файлов
        Storage::deleting(function ($storage) {
            Event::fire(new DeleteFromStorageEvent($storage));
        });

        //При удалении Записи - удаляем все связанный записи в хранилище
        Product::deleting(function ($product) {
            $storages = $product->storage;
            foreach ($storages as $storage)
            {
                $storage->delete();
            }
            return true;
        });

        Category::deleting(function ($category) {
            $storages = $category->storage;
            foreach ($storages as $storage)
            {
                $storage->delete();
            }
            return true;
        });

        User::deleting(function ($user) {
            $storages = $user->storage;
            foreach ($storages as $storage)
            {
                $storage->delete();
            }
            return true;
        });

        Order::deleting(function ($order) {
            $storages = $order->storage;
            foreach ($storages as $storage)
            {
                $storage->delete();
            }
            return true;
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
        if ($this->app->environment() !== 'production') {
            $this->app->register(\GrahamCampbell\Exceptions\ExceptionsServiceProvider::class);
            $this->app->register(\Barryvdh\Debugbar\ServiceProvider::class);
        }
    }
}
