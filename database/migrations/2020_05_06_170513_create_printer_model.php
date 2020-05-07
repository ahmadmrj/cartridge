<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrinterModel extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('printer_models', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('family_id')->index();
            $table->string('title');
            $table->timestamps();

            $table->foreign('family_id')->references('id')->on('printer_families');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('printer_models');
    }
}
