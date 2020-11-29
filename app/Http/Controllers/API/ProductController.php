<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\ShopProduct;
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
        $res = \DB::connection('shop')->select(\DB::raw(ShopProduct::getMainquery()));

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
