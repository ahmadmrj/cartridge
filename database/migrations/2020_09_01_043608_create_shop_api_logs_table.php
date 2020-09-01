<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShopApiLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shop_api_logs', function (Blueprint $table) {
            $table->id();
            $table->integer('product_code');
            $table->string('product_name');
            $table->string('attribute_name')->nullable();
            $table->string('change_field');
            $table->string('change_value');
            $table->string('ip_address');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shop_api_logs');
    }
}
