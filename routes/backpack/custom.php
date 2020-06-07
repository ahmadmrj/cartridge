<?php

// --------------------------
// Custom Backpack Routes
// --------------------------
// This route file is loaded automatically by Backpack\Base.
// Routes you generate using Backpack\Generators will be placed here.

Route::group([
    'prefix'     => config('backpack.base.route_prefix', 'admin'),
    'middleware' => ['web', config('backpack.base.middleware_key', 'admin')],
    'namespace'  => 'App\Http\Controllers\Admin',
], function () { // custom admin routes
    Route::crud('printerbrand', 'PrinterBrandCrudController');
    Route::crud('printerfamily', 'PrinterFamilyCrudController');
    Route::crud('printermodel', 'PrinterModelCrudController');
    Route::crud('cartridge', 'CartridgeCrudController');

    Route::post('cartridge/{id}/cart-media-upload', 'CartridgeCrudController@uploadMedia');
}); // this should be the absolute last line of this file
