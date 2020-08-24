<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\ShopProduct;
use App\Models\ShopProductAttribute;
use App\Models\ShopProductShop;
use App\Models\ShopStockAvailable;
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
            pts_manufacturer.name AS brand,
            CONCAT(pts_attribute_group_lang.`name`, " - ", pts_attribute_lang.name) AS combinationName,
            IF(pts_product_attribute.price != 0.000000,pts_product.`price`+pts_product_attribute.price,pts_product.`price`) AS price,
            pts_product.`wholesale_price`,
            pts_category.id_category,
            pts_category.id_parent,
            pts_product.`weight`,
            IF(pts_product_attribute_combination.id_product_attribute IS NULL, (
                SELECT quantity FROM pts_stock_available WHERE pts_stock_available.id_product = pts_product.id_product
            ),
            (
                SELECT quantity FROM pts_stock_available WHERE pts_stock_available.id_product = pts_product.id_product AND pts_stock_available.id_product_attribute = pts_product_attribute_combination.id_product_attribute
            )
            ) AS quantity,
            pts_product_attribute_combination.id_product_attribute
        FROM `pts_product`
        INNER JOIN pts_product_lang ON pts_product_lang.id_product = pts_product.id_product
        INNER JOIN pts_category ON pts_category.id_category = pts_product.id_category_default
        INNER JOIN pts_category_lang ON pts_category_lang.id_category = pts_category.id_category
        LEFT JOIN pts_manufacturer ON pts_manufacturer.id_manufacturer = pts_product.id_manufacturer
        LEFT JOIN pts_product_attribute ON pts_product_attribute.id_product = pts_product.id_product
        LEFT JOIN pts_product_attribute_combination ON pts_product_attribute_combination.id_product_attribute = pts_product_attribute.id_product_attribute
        LEFT JOIN pts_attribute_lang ON pts_attribute_lang.id_attribute = pts_product_attribute_combination.id_attribute
        LEFT JOIN pts_attribute ON pts_attribute.id_attribute = pts_product_attribute_combination.id_attribute
        LEFT JOIN pts_attribute_group_lang ON pts_attribute_group_lang.id_attribute_group = pts_attribute.id_attribute_group
        
        WHERE
            pts_category.level_depth > 2
        GROUP BY pts_product.`id_product`, pts_product_attribute_combination.id_product_attribute
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
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $id_product_attribute = $request->post('attribute_id');
        $shopPrd = null;

        if($id_product_attribute) {
            $prd = ShopProductAttribute::where('id_product', $id)->where('id_product_attribute', $id_product_attribute)->first();
        } else {
            $prd = ShopProduct::where('id_product', $id)->first();
            $shopPrd = ShopProductShop::where('id_product', $id)->first();
        }

        if($request->post('price')) {
            $prd->price = $request->post('price');
            if($shopPrd) {
                $shopPrd->price = $request->post('price');
                $shopPrd->save(['timestamps' => false]);
            }
        }

        if($request->post('wholesale_price')) {
            $prd->wholesale_price = $request->post('wholesale_price');
            if($shopPrd) {
                $shopPrd->wholesale_price = $request->post('wholesale_price');
                $shopPrd->save(['timestamps' => false]);
            }
        }

        if($request->post('quantity')) {
            if($id_product_attribute) {
                $shopStock = ShopStockAvailable::where('id_product', $id)
                    ->where('id_product_attribute', $id_product_attribute)
                    ->first();
            } else {
                $shopStock = ShopStockAvailable::where('id_product', $id)->first();
            }
            $prd->quantity = $request->post('quantity');
            $shopStock->quantity = $request->post('quantity');
            $shopStock->save(['timestamps' => false]);
        }

        $prd->save(['timestamps' => false]);

        return response()->json(['msg' => 'بروزرسانی قیمت انجام شد.' . $id], 200);
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
