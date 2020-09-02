<?php
namespace App\Services\ShopUpdater;

class PriceUpdater extends ShopUpdaterGeneral implements ShopUpdater {

    public function update()
    {
        if($this->attribute) {
            $this->attribute->price = $this->value - $this->product->price;
            $this->attributeShop->price = $this->value - $this->product->price;
            $this->attribute->save(['timestamps' => false]);
            $this->attributeShop->save(['timestamps' => false]);
        } else {
            $this->product->price = $this->value;
            $this->productShop->price = $this->value;
            $this->product->save(['timestamps' => false]);
            $this->productShop->save(['timestamps' => false]);
        }
    }
}
