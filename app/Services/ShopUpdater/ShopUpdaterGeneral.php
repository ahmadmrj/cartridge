<?php
namespace App\Services\ShopUpdater;


use App\Events\ShopProductUpdate;
use App\Models\ShopProduct;
use App\Models\ShopProductAttribute;
use App\Models\ShopProductAttributeShop;
use App\Models\ShopProductShop;
use http\Exception\RuntimeException;

class ShopUpdaterGeneral implements ShopUpdater {

    public $value;
    public $product;
    public $productShop;
    public $attribute = null;
    public $attributeShop = null;
    public $modifiedField = null;

    public function __construct($value)
    {
        $this->value = $value;
    }

    public function init($id_product, $id_product_attribute) {
        $this->product = ShopProduct::where('id_product', $id_product)->first();
        $this->productShop = ShopProductShop::where('id_product', $id_product)->first();

        if($id_product_attribute) {
            $this->attribute = ShopProductAttribute::where('id_product', $id_product)->where('id_product_attribute', $id_product_attribute)->first();
            $this->attributeShop = ShopProductAttributeShop::where('id_product', $id_product)->where('id_product_attribute', $id_product_attribute)->first();
        }
    }

    public function update()
    {
        // TODO: Implement update() method.
    }

    public function log() {
        try {
            event(new ShopProductUpdate($this->product, $this->attribute, $this->modifiedField, $this->value));
        } catch (RuntimeException $e) {
            // Take it easy if socket not working :D
            return true;
        }
    }
}
