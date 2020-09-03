<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\ShopApiLog;
use Illuminate\Http\Request;

class ShopApiLogController extends Controller
{
    public function index()
    {
        $res = ShopApiLog::orderByDesc('id')->paginate(30);

        return response()->json($res, 200);
    }
}
