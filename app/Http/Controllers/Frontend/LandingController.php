<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cartridge;
use App\Models\CartridgeMedia;
use App\Models\MissedCartridge;
use App\Models\PrinterBrand;
use App\Models\PrinterFamily;
use App\Models\PrinterModel;
use App\Models\PrinterModelMedia;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Route;
use stdClass;

class LandingController extends Controller
{
    public function index() {
        $brands = PrinterBrand::where('active',1)->get();

        $cartridgeList = Cartridge::with('medias')
            ->has('medias')
            ->whereNotNull(['buy_link'])
            ->limit(8)
            ->get();

        $printerList = PrinterModel::with('medias')
            ->whereNotNull(['buy_link'])
            ->where('buy_link','!=', '')
            ->limit(8)
            ->get();

        return view('frontend.landing', compact('brands', 'cartridgeList', 'printerList'));
    }

    public function familyList($slug) {
        $families = PrinterFamily::whereHas('brand', function($query) use($slug){
            $query->where('slug', $slug);
        })->get();

        return json_encode($families);
    }

    public function modelList(Request $request) {
        $family = $request->get('family');
        $brand = $request->get('brand');

        if($family) {
            $models = PrinterModel::where('family_id', $family)->get();
        } else {
            $models = PrinterModel::whereHas('family.brand', function($q) use($brand) {
                $q->whereSlug($brand);
            })->get();
        }

        return json_encode($models);
    }

    public function cartridgeList($slug) {
        $carts = Cartridge::with('medias')
            ->whereHas('printers', function ($sql) use($slug){
                $sql->where('slug', $slug);
            })->get()->all();

        foreach ($carts as $cart) {
//            dd($cart);
            if(isset($cart->medias[0])) {
//                dd($cart->medias);
                $cart->picture = 'uploads/'.$cart->medias[0]->address;
            } else {
                $cart->picture = "/images/no_img.png";
            }
        }

        return json_encode($carts);
    }

    public function cartridgeMediaList($id) {
        $images = CartridgeMedia::where('cartridge_id', $id)
            ->get()
            ->all();

        foreach ($images as $img){
            $img->size = \Storage::disk('public_uploads')->size($img->address);
            $img->pure_address = $img->address;
            $img->address = asset('uploads/'.$img->address);
        }

        return json_encode($images);
    }

    public function printerMediaList($id) {
        $images = PrinterModelMedia::where('printer_model_id', $id)
            ->get()
            ->all();

        foreach ($images as $img){
            $img->size = \Storage::disk('public_uploads')->size($img->address);
            $img->pure_address = $img->address;
            $img->address = asset('uploads/'.$img->address);
        }

        return json_encode($images);
    }

    public function elastic(Request $request) {
        $term = $request->get('term');
        $mainRes = new stdClass();
        $res = new stdClass();
        $res2 = new stdClass();
        $cartRes = [];
        $prntRes = [];
        if($term) {
            $cartRes = Cartridge::select(
                    \DB::raw("DISTINCT cartridges.id, CONCAT(printer_brands.title, ' ', cartridges.title) AS text, 'cart' AS type, cartridges.slug")
                )
                ->join('printer_cartridge','printer_cartridge.cartridge_id', '=', 'cartridges.id')
                ->join('printer_models','printer_models.id', '=', 'printer_cartridge.printer_id')
                ->join('printer_families','printer_families.id', '=', 'printer_models.family_id')
                ->join('printer_brands','printer_families.brand_id', '=', 'printer_brands.id')
                ->where('cartridges.slug', 'like', '%' . $term . '%')
                ->limit(15)
                ->get()
                ->all();

            $prntRes = PrinterModel::select(
                    \DB::raw("DISTINCT printer_models.id, CONCAT(printer_brands.title, ' ', printer_models.title) AS text, 'printer' AS type, printer_models.slug")
                )
                ->join('printer_families','printer_families.id', '=', 'printer_models.family_id')
                ->join('printer_brands','printer_families.brand_id', '=', 'printer_brands.id')
                ->where('printer_models.slug', 'like', '%' . $term . '%')
                ->limit(15)
                ->get()
                ->all();
        }

        if($cartRes) {
            $res->text = "کارتریج ها";
            $res->children = $cartRes;
            $mainRes->results[] = $res;
        }

        if($prntRes) {
            $res2->text = "پرینترها";
            $res2->children = $prntRes;
            $mainRes->results[] = $res2;
        }

        return json_encode($mainRes);
    }

    public function missedCartridge(Request $request) {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'phone_number' => 'numeric|digits_between:9,12'
        ]);

        MissedCartridge::create($validatedData);

        return view('frontend.missed_cartridges');
    }
}
