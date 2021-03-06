<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterPrinter extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('printer_models', function (Blueprint $table) {
            $table->string('technical_title')->after('title')->nullable();
            $table->string('description')->after('slug')->nullable();
            $table->string('key_words')->after('slug')->nullable();
            $table->string('seo_title')->after('slug')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('printer_models', function (Blueprint $table) {
            //
        });
    }
}
