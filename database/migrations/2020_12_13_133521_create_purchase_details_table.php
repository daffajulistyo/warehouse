<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchaseDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('purchase_id');
            $table->timestamps();

            $table->foreign('purchase_id')->references('id')->on('purchases');
        });

        //Membuat constraint table purchases
        // Schema::table('purchases', function (Blueprint $table) {
        //     $table->foreign('supplier_id')->references('id')->on('suppliers');
        // });

        //Membuat constraint table purchase_details
        // Schema::table('purchase_details', function (Blueprint $table) {
        //     $table->foreign('purchase_id')->references('id')->on('purchases');
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('purchase_details');
    }
}
