<?php

namespace App\Providers;

use Event;
use File;
use Log;
use App\Events\DeleteFromStorageEvent;
use App\Models\Products\Product;
use App\Models\Products\ProductPrice;
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
        /*Event::listen('sleeping_owl.section.creating:'.Storage::class, function(ModelConfiguration $model, Storage $storage) {
            return false;
        });*/
        Storage::creating(function ($storage) {
            try{
                // TODO: Определить, из-за чего падает после редиректа. Перенести событие в SleepinOwl
                /** Обработка изображений из админки */
                if( $storage->sleeping_owl ){
                    $user_id = $storage->user_id ? $storage->user_id : null;
                    $order_id = $storage->order_id ? $storage->order_id : null;
                    $product_id = $storage->product_id ? $storage->product_id : null;
                    $category_id = $storage->category_id ? $storage->category_id : null;

                    $storage_path = false;
                    if( $user_id ) $storage_path = 'users';
                    if( $order_id ) $storage_path = 'orders';
                    if( $product_id ) $storage_path = 'products';
                    if( $category_id ) $storage_path = 'categories';

                    foreach( $storage->images as $image ){

                        if ( $storage_path ){
                            $new_path = str_replace('uploads', $storage_path, $image);
                            if( !File::move($image, $new_path) ){
                                Log::error('[Storage::creating] При копировании файла возникли проблемы', ['file' => $image]);
                            };
                        }

                        $slash = strripos( $image, '/' );
                        $dot = strripos( $image, '.' );
                        if( $slash and $dot ){
                            $uuid = substr( $image, $slash + 1, $dot - $slash - 1 );
                            $ext = substr( $image, $dot + 1 );
                        }else{
                            Log::error('[Storage::creating] Не смогли разобрать имя файла', ['file' => $image]);
                        }

                        $strg = new Storage;

                        $strg->user_id = $user_id;
                        $strg->order_id = $order_id;
                        $strg->product_id = $product_id;
                        $strg->category_id = $category_id;
                        $strg->path = 'path';
                        $strg->name = $uuid ? $uuid : 'name';
                        $strg->uuid = $uuid ? $uuid : 'name';
                        $strg->extension = $ext ? $ext : 'jpg';
                        $strg->enable = true;

                        $strg->save();
                    }
                    return false;
                }
            }catch(\Exception $e){
                Log::error('[Storage::creating] При созхранении файлов упали с ошибкой', [
                    'error' => $e->getMessage(),
                    'storage' => $storage
                ]);
                return false;
            }
        });

        //Перед добавлением новой цены, старые для этого id продукта удаляем
        ProductPrice::creating(function ($price) {
            if($price->product_id){
                $all = ProductPrice::where('product_id', $price->product_id);
                $all->delete();
            }
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
            $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
            $this->app->register(\Barryvdh\Debugbar\ServiceProvider::class);
        }
    }
}
