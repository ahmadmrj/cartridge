<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
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
        return ['shopProduct'];
    }

    public function broadcastWith() {
        return [
            'id_product' => $this->product->id_product,
            'id_product_attribute' => $this->attribute ? $this->attribute->id_product_attribute : null,
            'modifiedField' => $this->modifiedFiled,
            'modifiedValue' => $this->modifiedValue
        ];
    }
}
