<?php
namespace App\Services\ShopUpdater;

use App\Models\ShopAttributeExtra;
use App\Models\ShopProductExtra;
use App\Models\ShopStockAvailable;

class DescriptionUpdater extends ShopUpdaterGeneral implements ShopUpdater {
    public function __construct($value)
    {
        parent::__construct($value);

        $this->modifiedField = 'description';
    }
    public function update()
    {
        if($this->attribute) {
            $extra = ShopAttributeExtra::where('id_product_attribute', $this->attribute->id_product_attribute)
                ->first();
            if(!$extra) {
                $extra = ShopAttributeExtra::create(['id_product_attribute' => $this->attribute->id_product_attribute]);
            }
        } else {
            $extra = ShopProductExtra::where('id_product', $this->product->id_product)->first();
            if(!$extra) {
                $extra = ShopProductExtra::create(['id_product' => $this->product->id_product]);
            }
        }

        $extra->description = $this->value;
        $extra->save(['timestamps' => false]);
    }
}
