<?php
namespace App\Services\ShopUpdater;

class WholesaleUpdater extends ShopUpdaterGeneral implements ShopUpdater {
    public function __construct($value)
    {
        parent::__construct($value);

        $this->modifiedField = 'wholesale_price';
    }

    public function update()
    {
        if($this->attribute) {
            $this->attribute->wholesale_price = $this->value - $this->product->wholesale_price;
            $this->attributeShop->wholesale_price = $this->value - $this->product->wholesale_price;
            $this->attribute->save(['timestamps' => false]);
            $this->attributeShop->save(['timestamps' => false]);
        } else {
            $this->product->wholesale_price = $this->value;
            $this->productShop->wholesale_price = $this->value;
            $this->product->save(['timestamps' => false]);
            $this->productShop->save(['timestamps' => false]);
        }
    }
}
