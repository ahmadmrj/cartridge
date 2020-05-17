<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cartridge;
use Illuminate\Http\Request;

class CartridgeController extends Controller
{
    public function view($title) {
        $cartridge = Cartridge::with('printers.family.brand')->whereSlug($title)->firstOrFail();

        return view('frontend.cartridge_view', compact('cartridge'));
    }
}
