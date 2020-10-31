<?php
namespace App\Services\ShopUpdater;

use App\Models\ShopStockAvailable;

class QuantityUpdater extends ShopUpdaterGeneral implements ShopUpdater {
    public function __construct($value)
    {
        parent::__construct($value);

        $this->modifiedField = 'quantity';
    }
    public function update()
    {
        if($this->attribute) {
            $shopStockBase = ShopStockAvailable::where('id_product', $this->attribute->id_product)
                ->where('id_product_attribute', 0)
                ->first();

            $shopStockBase->quantity = $shopStockBase->quantity + 1;
            $shopStockBase->save();

            $shopStock = ShopStockAvailable::where('id_product', $this->attribute->id_product)
                ->where('id_product_attribute', $this->attribute->id_product_attribute)
                ->first();
        } else {
            $shopStock = ShopStockAvailable::where('id_product', $this->product->id_product)->first();
            $this->product->quantity = $this->value;
            $this->product->save(['timestamps' => false]);
        }

        $shopStock->quantity = $this->value;
        $shopStock->save(['timestamps' => false]);
    }
}
