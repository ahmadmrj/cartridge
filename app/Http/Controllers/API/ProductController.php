<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Services\ShopUpdateStrategy;
use App\Services\UpdaterFactory;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $res = \DB::connection('shop')->select(\DB::raw('
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
            pts_product.active
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

        WHERE
            pts_category.level_depth > 2
        GROUP BY pts_product.`id_product`, pts_product_attribute_combination.id_product_attribute
        ORDER BY pts_product.`id_product`
        '));

        foreach ($res as $item) {
            $item->price = intval($item->price);
            $item->wholesale_price = intval($item->wholesale_price);
            $item->quantity = intval($item->quantity);
        }

        return response()->json($res, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function update(Request $request, $id)
    {
        $updater = new ShopUpdateStrategy(UpdaterFactory::selectMethodByRequest(
            $request->post('price'),
            $request->post('wholesale_price'),
            $request->post('quantity'),
            $request->post('description')
        ));

        $id_product_attribute = $request->post('attribute_id');
        $updater->updateShop($id, $id_product_attribute);

        return response()->json([
            'msg' => 'بروزرسانی قیمت انجام شد.' . $id
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
