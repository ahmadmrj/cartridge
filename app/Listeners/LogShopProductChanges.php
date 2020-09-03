<?php

namespace App\Listeners;

use App\Events\ShopProductUpdate;
use App\Models\ShopApiLog;
use App\Models\ShopAttributeLang;
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
        $attribute = null;
        if($event->attribute) {
            $attribute = ShopAttributeLang::find($event->attribute->id_product_attribute);
        }

        ShopApiLog::create([
            'product_code' => $event->product->id_product,
            'product_name' => $product->name,
            'attribute_name' => $attribute ? $attribute->name : '',
            'change_field' => $event->modifiedFiled,
            'change_value' => $event->modifiedValue,
            'ip_address' => \Request::ip()
        ]);
    }
}
