<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\ShopProduct;
use App\Models\ShopProductAttribute;
use App\Models\ShopSupplier;
use BeyondCode\LaravelWebSockets\Statistics\Events\StatisticsUpdated;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $suppliers = ShopSupplier::all();

        return response()->json($suppliers, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $info = ShopSupplier::create([
            'supplier_title' => $request->post('title')
        ]);

        $info->save(['timestamps' => false]);

        return response()->json([], 200);
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
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $supplier = ShopSupplier::find($id);

        if($supplier->has('products') || $supplier->has('attributes')) {
            return response()->json(['msg' => 'انجام عملیات ممکن نیست.'], 409);
        } else {
            $supplier->delete();
            return response()->json($supplier, 200);
        }
    }

    public function assign(Request $request) {
        $productId = $request->post('id_product');
        $attributeId = $request->post('id_attribute');
        $supplierId = $request->post('supplier_id');
        $where = 'AND ';

        if(is_null($attributeId)){
            $subjectModel = ShopProduct::with('suppliers')->where('id_product', $productId);
            $where .= 'pts_product.id_product=' . $productId;
        } else {
            $subjectModel = ShopProductAttribute::with('suppliers')->where('id_product', $productId)->where('id_product_attribute', $attributeId);
            $where .= 'pts_product.id_product=' . $productId . ' AND pts_product_attribute_combination.id_product_attribute=' . $attributeId;
        }

        $product = $subjectModel->firstOrFail();

        if(!$product->suppliers->contains($supplierId)) {
            $product->suppliers()->attach($supplierId);
        }

        $res = \DB::connection('shop')->select(\DB::raw(ShopProduct::getMainquery($where)));

        return response()->json($res[0], 200);
    }

    public function detach($product_id, $attribute_id, $supplier) {
        $productId = $product_id;
        $attributeId = $attribute_id;
        $supplier = ShopSupplier::where('supplier_title', $supplier)->firstOrFail();
        $where = 'AND ';

        if('null' === $attributeId){
            $subjectModel = ShopProduct::with('suppliers')->where('id_product', $productId);
            $where .= 'pts_product.id_product=' . $productId;
        } else {
            $subjectModel = ShopProductAttribute::with('suppliers')->where('id_product', $productId)->where('id_product_attribute', $attributeId);
            $where .= 'pts_product.id_product=' . $productId . ' AND pts_product_attribute_combination.id_product_attribute=' . $attributeId;
        }

        $product = $subjectModel->firstOrFail();

        $product->suppliers()->detach($supplier->id);

        $res = \DB::connection('shop')->select(\DB::raw(ShopProduct::getMainquery($where)));

        return response()->json($res[0], 200);
    }
}
