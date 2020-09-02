<?php

namespace App\Services;

use App\Services\ShopUpdater\ShopUpdater;

class ShopUpdateStrategy {
    private $strategy;

    public function __construct(ShopUpdater $updater)
    {
        $this->strategy = $updater;
    }

    public function updateShop($id, $id_product_attribute) {
        $this->strategy->init($id, $id_product_attribute);
        $this->strategy->update();
        $this->strategy->log();
    }
}
