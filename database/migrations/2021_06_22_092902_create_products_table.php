<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
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
            $table->string('cat_id')->nullable();
            $table->string('product_name')->nullable();
            $table->string('product_code')->nullable();
            $table->string('size')->nullable();
            $table->string('color')->nullable();
            $table->string('long_description')->nullable();
            $table->string('short_description')->nullable();
            $table->string('price')->nullable();
            $table->string('quantity')->nullable();
            $table->string('featured_product')->default(0);
            $table->string('popular_product')->default(0);
            $table->string('latest_product')->default(0);
            $table->string('status')->default(1);
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
}
