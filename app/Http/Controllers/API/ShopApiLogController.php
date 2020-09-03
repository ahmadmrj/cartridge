<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\ShopApiLog;
use Illuminate\Http\Request;

class ShopApiLogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $res = ShopApiLog::paginate(30);

        return response()->json($res, 200);
    }
}
