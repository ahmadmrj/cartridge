<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cartridge;
use App\models\PrinterBrand;
use App\Models\PrinterFamily;
use App\Models\PrinterModel;
use Illuminate\Http\Request;

class CartridgeController extends Controller
{
    public function index(Request $request) {
        $sel_brand = $request->get('brand');
        $sel_printer = $request->get('printer');
        $sel_family = null;
        $printer_slug = null;

        if($sel_printer) {
            $printer = PrinterModel::where('slug', $sel_printer)->get()->first();
            $printer_slug = $printer->slug;
            $sel_family = $printer->family->id;
            $sel_brand = $printer->family->brand->slug;
        }

        $carts = Cartridge::whereHas('printers', function ($query) use ($sel_printer){
            if($sel_printer) {
                $query->where('slug', $sel_printer);
            }
        })->whereHas('printers.family.brand', function ($query) use ($sel_brand) {
            if($sel_brand) {
                $query->where('slug', $sel_brand);
            }
        })->paginate(12);

        $brands = PrinterBrand::all();


        return view('frontend.cartridges', compact('carts', 'brands', 'sel_brand', 'sel_printer', 'sel_family', 'printer_slug'));
    }

    public function view($title) {
        $cartridge = Cartridge::with('printers.family.brand')->whereSlug($title)->firstOrFail();

        return view('frontend.cartridge_view', compact('cartridge'));
    }
}
