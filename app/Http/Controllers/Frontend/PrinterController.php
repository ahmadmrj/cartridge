<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\PrinterModel;
use Illuminate\Http\Request;

class PrinterController extends Controller
{
    public function view($title) {
        $printer = PrinterModel::with('family.brand')
            ->with('medias')
            ->whereSlug($title)
            ->firstOrFail();

        $seoTitle = $printer->title . ' | کارتریج یاب';

        if($printer->seo_title) $seoTitle = $printer->seo_title;
//        dd($cartridge->medias);
        return view('frontend.printer_view', compact('printer', 'seoTitle'));
    }
}
