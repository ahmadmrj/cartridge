<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
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
            pts_image_lang.legend,
            pts_category_lang.name AS cat,
            pts_manufacturer.name AS brand,
            pts_product.`price`,
            pts_product.`width`,
            pts_product.`height`,
            pts_product.`depth`,
            pts_product.`weight`
            FROM `pts_product`
            INNER JOIN pts_image ON pts_product.id_product = pts_image.id_product
            INNER JOIN pts_image_lang ON pts_image.id_image = pts_image_lang.id_image
            INNER JOIN pts_category_product ON pts_category_product.id_product = pts_product.id_product
            INNER JOIN pts_category ON pts_category.id_category = pts_category_product.id_category
            INNER JOIN pts_category_lang ON pts_category_lang.id_category = pts_category.id_category
            INNER JOIN pts_manufacturer ON pts_manufacturer.id_manufacturer = pts_product.id_manufacturer
            WHERE
            pts_image_lang.id_lang=1
            AND pts_category_lang.id_lang=1
        '));
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
        //
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