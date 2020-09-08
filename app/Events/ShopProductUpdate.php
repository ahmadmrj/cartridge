<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ShopProductUpdate implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $product;
    public $attribute;
    public $modifiedFiled;
    public $modifiedValue;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($product, $attribute, $modifiedFiled, $modifiedValue)
    {
        $this->product = $product;
        $this->attribute = $attribute;
        $this->modifiedFiled = $modifiedFiled;
        $this->modifiedValue = $modifiedValue;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('product.'.$this->product->id_product);
    }
}
