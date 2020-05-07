<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\models\PrinterBrand;
use App\Models\PrinterFamily;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function index() {
        $brands = PrinterBrand::all();

        return view('frontend.landing', compact('brands'));
    }

    public function familyList($id) {
        $families = PrinterFamily::where('brand_id', $id)->get();

        return json_encode($families);
    }
}
