<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

use App\Models\Storages\Storage;

class DeleteFromStorageEvent
{
    use InteractsWithSockets, SerializesModels;

    public $dir;
    public $uuid;
    public $extension;
    
    
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Storage $storage)
    {
        $this->dir = '';
        if ($storage->user_id) $this->dir = 'users/';
        if ($storage->order_id) $this->dir = 'orders/';
        if ($storage->product_id) $this->dir = 'products/';
        if ($storage->category_id) $this->dir = 'categories/';
        $this->uuid = $storage->uuid;
        $this->extension = $storage->extension;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
