<?php

namespace App\Listeners;

use App\Events\DeleteFromStorageEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use Log;
use File;
use Storage as LaravelStorage;

class DeleteFromStorageListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  DeleteFromStorageEvent  $event
     * @return void
     */
    public function handle(DeleteFromStorageEvent $event)
    {
        $root = LaravelStorage::disk('storage')->getDriver()->getAdapter()->getPathPrefix();
        $dir = '';
        if ($event->storage->user_id) $dir = 'users/';
        if ($event->storage->order_id) $dir = 'orders/';
        if ($event->storage->product_id) $dir = 'products/';
        if ($event->storage->category_id) $dir = 'categories/';
        $thumb_dir = 'thumbnails';
        $uuid = $event->storage->uuid;
        $extension = $event->storage->extension ? '.'.$event->storage->extension : '';

        try
        {
            if( File::exists( $root.$dir.$uuid.$extension ) )
            {
                // Удаляем сам файл
                Log::info('Удаляем файл хранилища', ['Файл' => $dir.$uuid.$extension]);
                File::delete( $root.$dir.$uuid.$extension );

                // Удаляем все thumbnails
                $thumbnails = File::files( $root.$dir.$thumb_dir );
                foreach ($thumbnails as $thumbnail)
                {
                    $exists = stripos( $thumbnail, $uuid, strlen($root.$dir) );
                    if( $exists !== false )
                    {
                        Log::info('Удаляем черновик', ['Черновик' => $thumbnail]);
                        File::delete( $thumbnail );
                    }
                }
            }
            else
            {
                Log::info('Удаляемый файл не найден в хранилище', ['Файл' => $dir.$uuid.$extension]);
            }
        }
        catch (\Exception $e)
        {
            Log::warning('Не смогли удалить файл', ['Файл' => $dir.$uuid.$extension, 'Сообщение' => $e->getMessage()]);

        }



    }
}
