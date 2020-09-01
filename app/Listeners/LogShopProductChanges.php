<?php

namespace App\Listeners;

use App\Events\ShopProductUpdate;
use App\Model\ShopApiLog;
use App\Models\ShopProductLang;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class LogShopProductChanges
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
     * @param  ShopProductUpdate  $event
     * @return void
     */
    public function handle(ShopProductUpdate $event)
    {
        $product = ShopProductLang::find($event->product->id_product);

        ShopApiLog::create([
            'product_code' => $event->product->id_product,
            'product_name' => $product->name,
            'change_field',
            'change_value',
            'ip_address'
        ]);
    }
}
