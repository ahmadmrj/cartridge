<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cartridge;
use App\models\CartridgeMedia;
use App\models\PrinterBrand;
use App\Models\PrinterFamily;
use App\Models\PrinterModel;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use stdClass;

class LandingController extends Controller
{
    public function index() {
        $brands = PrinterBrand::all();
        $cartridges = Cartridge::has('medias')
            ->whereNotNull(['buy_link'])
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

    public function cartridgeList($slug) {
        $carts = Cartridge::select(
                'title',
                \DB::raw('IF(picture is null, "/images/no_img.png", picture) as picture'),
                'color',
                'page_yield',
                'slug'
            )
            ->whereHas('printers', function ($sql) use($slug){
                $sql->where('slug', $slug);
        })->get();

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
                ->limit(6)
                ->get()
                ->all();

            $prntRes = PrinterModel::select(
                    'id',
                    \DB::raw('title AS text'),
                    \DB::raw('"printer" AS type'),
                    'slug'
                )
                ->where('slug', 'like', '%' . $term . '%')
                ->limit(6)
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
