<?php
namespace App\Services\ShopUpdater;

class PriceUpdater extends ShopUpdaterGeneral implements ShopUpdater {
    public function __construct($value)
    {
        parent::__construct($value);

        $this->modifiedField = 'price';
    }

    public function update()
    {
        if($this->attribute) {
            if($this->product->price < 5 && $this->value > 0) {
                $this->product->price = 4;
                $this->productShop->price = 4;
                $this->product->save();
                $this->productShop->save();
            }

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
