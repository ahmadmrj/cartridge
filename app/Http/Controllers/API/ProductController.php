<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\ShopProduct;
use App\Models\ShopProductShop;
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
            pts_product.`price`,
            pts_product.`wholesale_price`,
            pts_stock_available.`quantity`,
            pts_category.id_category,
            pts_category.id_parent,
            pts_product.`weight`
            FROM `pts_product`
            INNER JOIN pts_product_lang ON pts_product_lang.id_product = pts_product.id_product
            INNER JOIN pts_category ON pts_category.id_category = pts_product.id_category_default
            INNER JOIN pts_category_lang ON pts_category_lang.id_category = pts_category.id_category
            LEFT JOIN pts_manufacturer ON pts_manufacturer.id_manufacturer = pts_product.id_manufacturer
            LEFT JOIN pts_stock_available ON pts_stock_available.id_product = pts_product.id_product
            WHERE
            pts_category.level_depth > 2
            GROUP BY pts_product.`id_product`
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
        $prd = ShopProduct::where('id_product', $id)->first();
        $shopPrd = ShopProductShop::where('id_product', $id)->first();
//        $shopPrd = ShopProductShop::where('id_product', $id)->first();

        $prd->timestamps = false;
        $shopPrd->timestamps = false;

        if($request->post('price')) {
            $prd->price = $request->post('price');
            $shopPrd->price = $request->post('price');
        }
        if($request->post('wholesale_price')) {
            $prd->wholesale_price = $request->post('wholesale_price');
            $shopPrd->wholesale_price = $request->post('wholesale_price');
        }
        if($request->post('quantity')) {
            $prd->quantity = $request->post('quantity');
        }
        if($request->post('quantity')) {
            $prd->quantity = $request->post('quantity');
        }

        $prd->save(['timestamps' => false]);
        $shopPrd->save(['timestamps' => false]);

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
