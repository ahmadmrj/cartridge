<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        if($request->post('username') == 'apiuser' && $request->post('password') == 'apisecret') {
            return response()->json(['allowed' => true, 'msg' => 'ورود با موفقیت انجام شد.'], 200);
        } else {
            return response()->json(['allowed' => false, 'msg' => 'خطا در اطلاعات ورود به سامانه.'], 200);
        }
    }
}
