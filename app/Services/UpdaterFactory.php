<?php
namespace App\Services;

use App\Services\ShopUpdater\PriceUpdater;
use App\Services\ShopUpdater\QuantityUpdater;
use App\Services\ShopUpdater\WholesaleUpdater;

class UpdaterFactory {
    public static function selectMethodByRequest($price, $wholePrice, $quantity) {
        if($price) {
            return new PriceUpdater($price);
        } elseif($wholePrice) {
            return new WholesaleUpdater($wholePrice);
        } elseif($quantity) {
            return new QuantityUpdater($quantity);
        } else {
            throw new \Exception("Unknown Update Method");
        }
    }
}
