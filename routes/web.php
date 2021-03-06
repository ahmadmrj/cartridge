<?php

use App\models\PrinterBrand;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\SitemapGenerator;
use Spatie\Sitemap\Tags\Url;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'Frontend\LandingController@index');
Route::get('family-list/{id}', 'Frontend\LandingController@familyList');
Route::get('model-list', 'Frontend\LandingController@modelList');
Route::get('cartridge/{title}', 'Frontend\CartridgeController@view');
Route::get('printer/{title}', 'Frontend\PrinterController@view');
Route::get('cartridges', 'Frontend\CartridgeController@index');
Route::get('cartridge-list/{id}', 'Frontend\LandingController@cartridgeList');
Route::get('cartridge-media-list/{id}', 'Frontend\LandingController@cartridgeMediaList');
Route::get('printer-media-list/{id}', 'Frontend\LandingController@printerMediaList');
Route::get('elastic', 'Frontend\LandingController@elastic');
Route::post('missed-cartridge', 'Frontend\LandingController@missedCartridge');


//Route::get('/carts', function () {
//    $asaks = DB::table('temp')->get();
//    foreach ($asaks as $asak){
//        $printer = DB::table('printer_models')->where('title', $asak->printer)->get();
//        $card = DB::table('cartridges')->where('title', $asak->cartridge)->get();
//        if($printer[0]) {
//            DB::table('printer_cartridge')->insert([
//                'printer_id'=>$printer[0]->id,
//                'cartridge_id'=>$card[0]->id
//            ]);
//        } else {
//            echo 'err:'.$asak->printer.'<br>';
//        }
//    }
//});
//
//Route::get('/refines', function () {
//    die('asdf');
//    \App\Models\Cartridge::all()->each(function ($cart) {
//        $str = $cart->title;
//        $cart->title = $str.'*';
//        $cart->save();
//        $cart->title = str_replace('*', '', $cart->title);
//        $cart->save();
//        echo 'asdf';
//    });
//});

//Route::get('/usr', function () {
//    $usr = \App\User::where('id', 1)->first();
//    $usr->password = Hash::make('123456');
//    $usr->save();
//    echo $usr->password;
//});

Route::get('/map', function () {
    $sitemap = Sitemap::create()->add(Url::create('/'));

    PrinterBrand::all()->each(function (PrinterBrand $brand) use ($sitemap) {
        $sitemap->add(Url::create("/cartridges?brand={$brand->slug}")
            ->setLastModificationDate(Carbon::yesterday())
            ->setChangeFrequency(Url::CHANGE_FREQUENCY_YEARLY)
            ->setPriority(0.1));
    });

    \App\Models\Cartridge::all()->each(function ($cart) use ($sitemap) {
        $sitemap->add(Url::create("/cartridge/{$cart->slug}")
            ->setLastModificationDate(Carbon::yesterday())
            ->setChangeFrequency(Url::CHANGE_FREQUENCY_YEARLY)
            ->setPriority(0.9));
    });

    $sitemap->writeToFile('sitemap.xml');
});
