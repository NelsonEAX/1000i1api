<?php

namespace App\Listeners;

use App\Events\DeleteFromStorageEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use Log;

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
        Log::info('Удаляем файлы хранилища', ['Файл' => $event->dir.'|'.$event->uuid.'|'.$event->extension]);
    }
}
