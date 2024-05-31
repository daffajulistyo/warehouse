<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemPurchaseDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_purchase_detail', function (Blueprint $table) {
            $table->foreignId('item_id');
            $table->foreignId('purchase_detail_id');
            $table->integer('jumlah');
            $table->timestamps();

            $table->foreign('item_id')->references('id')->on('items');
            $table->foreign('purchase_detail_id')->references('id')->on('purchase_details');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('item_purchase_detail');
    }
}
