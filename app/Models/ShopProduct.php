<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShopProduct extends Model
{
    protected $connection = 'shop';
    protected $table = 'pts_product';
    protected $primaryKey = 'id_product';
    public $timestamps = false;

    public static function getMainquery($extraWhere = '')
    {
        return '
        SELECT
            pts_product.`id_product`,
            pts_product_lang.name as legend,
            pts_category_lang.name AS cat,
            CONCAT(pts_attribute_group_lang.`name`, " - ", pts_attribute_lang.name) AS combinationName,
            IF(pts_product_attribute.price != 0.000000,pts_product.`price`+pts_product_attribute.price,pts_product.`price`) AS price,
            pts_product.`wholesale_price`,
            pts_category.id_category,
            pts_category.id_parent,
            IF(pts_product_attribute_combination.id_product_attribute IS NULL, (
                SELECT quantity FROM pts_stock_available WHERE pts_stock_available.id_product = pts_product.id_product
                AND pts_stock_available.id_product_attribute=0
            ),
            (
                SELECT quantity FROM pts_stock_available WHERE pts_stock_available.id_product = pts_product.id_product AND pts_stock_available.id_product_attribute = pts_product_attribute_combination.id_product_attribute
            )
            ) AS quantity,
            pts_product_attribute_combination.id_product_attribute,
            IF(pts_product_attribute_combination.id_product_attribute IS NULL, crm_product_extra_info.description, crm_attribute_extra_info.description) AS description,
            pts_product.active,
            GROUP_CONCAT(crm_supplier.supplier_title) AS suppliers
        FROM `pts_product`
        INNER JOIN pts_product_lang ON pts_product_lang.id_product = pts_product.id_product
        INNER JOIN pts_category ON pts_category.id_category = pts_product.id_category_default
        INNER JOIN pts_category_lang ON pts_category_lang.id_category = pts_category.id_category
        LEFT JOIN pts_product_attribute ON pts_product_attribute.id_product = pts_product.id_product
        LEFT JOIN pts_product_attribute_combination ON pts_product_attribute_combination.id_product_attribute = pts_product_attribute.id_product_attribute
        LEFT JOIN pts_attribute_lang ON pts_attribute_lang.id_attribute = pts_product_attribute_combination.id_attribute
        LEFT JOIN pts_attribute ON pts_attribute.id_attribute = pts_product_attribute_combination.id_attribute
        LEFT JOIN pts_attribute_group_lang ON pts_attribute_group_lang.id_attribute_group = pts_attribute.id_attribute_group
        LEFT JOIN crm_product_extra_info ON crm_product_extra_info.id_product = pts_product.id_product
        LEFT JOIN crm_attribute_extra_info ON crm_attribute_extra_info.id_product_attribute = pts_product_attribute.id_product_attribute
        LEFT JOIN supplierables ON supplierables.supplierable_id = (case when pts_product_attribute_combination.id_product_attribute is null
            THEN pts_product.`id_product` ELSE pts_product_attribute_combination.id_product_attribute END
        ) AND supplierables.supplierable_type LIKE (case when pts_product_attribute_combination.id_product_attribute is null
            THEN "%ShopProduct" ELSE "%ShopProductAttribute" END)
        LEFT JOIN crm_supplier on crm_supplier.id = supplierables.shop_supplier_id
        WHERE
            pts_category.level_depth > 2 AND pts_product.active=1 '.$extraWhere.'
        GROUP BY pts_product.`id_product`, pts_product_attribute_combination.id_product_attribute
        ORDER BY pts_product.`id_product`
        ';
    }

    public function suppliers()
    {
        return $this->morphToMany(ShopSupplier::class, 'supplierable');
    }
}
