<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cartridge;
use App\models\PrinterBrand;
use App\Models\PrinterFamily;
use App\Models\PrinterModel;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function index() {
        $brands = PrinterBrand::all();
        $cartridges = Cartridge::whereNotNull('buy_link')->limit(10);

        return view('frontend.landing', compact('brands', 'cartridges'));
    }

    public function familyList($id) {
        $families = PrinterFamily::where('brand_id', $id)->get();

        return json_encode($families);
    }

    public function modelList($id) {
        $models = PrinterModel::where('family_id', $id)->get();

        return json_encode($models);
    }
}
