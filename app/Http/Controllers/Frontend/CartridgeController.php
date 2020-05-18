<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cartridge;
use Illuminate\Http\Request;

class CartridgeController extends Controller
{
    public function index(Request $request) {
        $carts = Cartridge::whereHas('printers', function ($query) use ($request){
            if($request->get('printer')) {
                $query->where('slug', $request->get('printer'));
            }
        })->paginate(12);

        return view('frontend.cartridges', compact('carts'));
    }

    public function view($title) {
        $cartridge = Cartridge::with('printers.family.brand')->whereSlug($title)->firstOrFail();

        return view('frontend.cartridge_view', compact('cartridge'));
    }
}
