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
        $cartridges = Cartridge::whereNotNull(['buy_link', 'picture'])
            ->limit(8)
            ->get();

        return view('frontend.landing', compact('brands', 'cartridges'));
    }

    public function familyList($slug) {
        $families = PrinterFamily::whereHas('brand', function($query) use($slug){
            $query->where('slug', $slug);
        })->get();

        return json_encode($families);
    }

    public function modelList($id) {
        $models = PrinterModel::where('family_id', $id)->get();

        return json_encode($models);
    }

    public function cartridgeList($id) {
        $carts = Cartridge::select(
                'title',
                \DB::raw('IF(picture is null, "/images/no_img.png", picture) as picture'),
                'color',
                'page_yield',
                'slug'
            )
            ->whereHas('printers', function ($sql) use($id){
            $sql->where('printer_id', $id);
        })->get();

        return json_encode($carts);
    }
}
