<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\ShopApiLog;
use Illuminate\Http\Request;

class ShopApiLogController extends Controller
{
    public function index(Request $request)
    {
        $query = ShopApiLog::orderByDesc('id');

        if($request->get('product_name')) {
            $query->where('product_name', 'like', '%'.$request->get('product_name').'%');
        }
        if($request->get('attribute_name')) {
            $query->where('attribute_name', 'like', '%'.$request->get('attribute_name').'%');
        }
        if($request->get('change_field')) {
            $query->where('change_field', 'like', '%'.$request->get('change_field').'%');
        } 

        $res = $query->paginate(30);

        return response()->json($res, 200);
    }
}
