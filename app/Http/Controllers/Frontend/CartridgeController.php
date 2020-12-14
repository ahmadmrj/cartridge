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
        $sel_family = $request->get('family') ?? null;
        $sel_printer = $request->get('printer');
        $available = $request->get('available-check') ?? null;
        $printer_slug = null;
        $seoTitle = 'کارتریج یاب';

        if($sel_printer) {
            $printer = PrinterModel::where('slug', $sel_printer)->get()->first();
            $seoTitle .= ' | '.$printer->title;
            $printer_slug = $printer->slug;
            $sel_family = $printer->family->id;
            $sel_brand = $printer->family->brand->slug;
        }

        $qq = Cartridge::whereHas('printers', function ($query) use ($sel_printer){
            if($sel_printer) {
                $query->where('slug', $sel_printer);
            }
        })->whereHas('printers.family', function ($query) use ($sel_family) {
            if($sel_family) {
                $query->where('id', $sel_family);
            }    
        })->whereHas('printers.family.brand', function ($query) use ($sel_brand) {
            if($sel_brand) {
                $query->where('slug', $sel_brand);
            }
        });

        if($available) {
            $qq->whereNotNull('buy_link');
        }
        
        $carts = $qq->paginate(12)->withQueryString();

        $brands = PrinterBrand::all();


        return view('frontend.cartridges', compact(
            'carts', 
            'brands', 
            'sel_brand', 
            'sel_printer', 
            'sel_family', 
            'printer_slug', 
            'seoTitle',
            'available'
        ));
    }

    public function view($title) {
        $cartridge = Cartridge::with('printers.family.brand')
            ->with('medias')
            ->whereSlug($title)
            ->firstOrFail();
        $seoTitle = $cartridge->title . ' | کارتریج یاب';

        if($cartridge->seo_title) $seoTitle = $cartridge->seo_title;
//        dd($cartridge->medias);
        return view('frontend.cartridge_view', compact('cartridge', 'seoTitle'));
    }
}
