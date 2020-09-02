<?php
namespace App\Services\ShopUpdater;

interface ShopUpdater {
    public function init($id_product, $id_product_attribute);
    public function update();
}
