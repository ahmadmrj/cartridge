<?php
namespace App\Services\ShopUpdater;

use App\Models\ShopStockAvailable;

class QuantityUpdater extends ShopUpdaterGeneral implements ShopUpdater {

    public function update()
    {
        if($this->attribute) {
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
