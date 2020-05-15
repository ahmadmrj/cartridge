<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

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
Route::get('model-list/{id}', 'Frontend\LandingController@modelList');
Route::get('cartridge-list/{id}', 'Frontend\LandingController@cartridgeList');


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

//Route::get('/refines', function () {
//    $carts = DB::table('cartridges')->get();
//    foreach ($carts as $cart){
//        if(!file_exists($cart->picture)){
//            echo $cart->picture.'<br>';
//            DB::table('cartridges')->where('id', $cart->id)->update(['picture' => null]);
//        }
//    }
//});

Route::get('/usr', function () {
    $usr = \App\User::where('id', 1)->first();
    $usr->password = Hash::make('123456');
    $usr->save();
    echo $usr->password;
});
