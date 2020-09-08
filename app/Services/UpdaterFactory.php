<?php
namespace App\Services;

use App\Services\ShopUpdater\DescriptionUpdater;
use App\Services\ShopUpdater\PriceUpdater;
use App\Services\ShopUpdater\QuantityUpdater;
use App\Services\ShopUpdater\WholesaleUpdater;

class UpdaterFactory {
    public static function selectMethodByRequest($price, $wholePrice, $quantity, $description) {
        if(!is_null($price)) {
            return new PriceUpdater($price);
        } elseif(!is_null($wholePrice)) {
            return new WholesaleUpdater($wholePrice);
        } elseif(!is_null($quantity)) {
            return new QuantityUpdater($quantity);
        } elseif(!is_null($description)) {
            return new DescriptionUpdater($description);
        } else {
            throw new \Exception("Unknown Update Method");
        }
    }
}
