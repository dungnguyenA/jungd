<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table ->string('product_name');
            $table ->integer('price');
            $table ->integer('discount_price');
            $table ->integer('quantity');
            $table ->text('description');
            $table ->integer('view')->nullable();
            $table ->integer('category_id')->nullable();
            $table ->integer('brand_id')->nullable();
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
        Schema::dropIfExists('products');
    }
};
