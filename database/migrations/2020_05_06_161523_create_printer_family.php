<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrinterFamily extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('printer_families', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('brand_id')->index();
            $table->string('title');
            $table->timestamps();
        });

        Schema::table('printer_families', function (Blueprint $table) {
            $table->foreign('brand_id')->references('id')->on('printer_brands');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('printer_families');
    }
}
