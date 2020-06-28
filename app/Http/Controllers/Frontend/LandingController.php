<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cartridge;
use App\Models\CartridgeMedia;
use App\Models\PrinterBrand;
use App\Models\PrinterFamily;
use App\Models\PrinterModel;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Route;
use stdClass;

class LandingController extends Controller
{
    public function index() {
        $brands = PrinterBrand::all();
        $cartridgeList = Cartridge::has('medias')
            ->whereNotNull(['buy_link'])
            ->limit(8)
            ->get();

            return view('frontend.landing', compact('brands', 'cartridgeList'));
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
                    'id',
                    \DB::raw('title AS text'),
                    \DB::raw('"cart" AS type'),
                    'slug'
                )
                ->where('slug', 'like', '%' . $term . '%')
                ->limit(60)
                ->get()
                ->all();

            $prntRes = PrinterModel::select(
                    'id',
                    \DB::raw('title AS text'),
                    \DB::raw('"printer" AS type'),
                    'slug'
                )
                ->where('slug', 'like', '%' . $term . '%')
                ->limit(60)
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
}
