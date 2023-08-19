<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsSkuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql2')->create('products_sku', function (Blueprint $table) {
            $table->id();
            $table->string('sku_code', 64)->nullable();
            $table->string('max_price', 64)->nullable();
            $table->string('offer_price', 64)->nullable();
            $table->boolean('tax_inclusive')->nullable();
            $table->string('upc_number', 64)->nullable();
            $table->integer('total_stock')->nullable();
            $table->integer('ordered_stock')->nullable();
            $table->integer('threshold_stock')->nullable();
            $table->integer('returned_stock')->nullable();
            $table->string('package_type', 64)->nullable();
            $table->float('length', 8, 2)->nullable();
            $table->float('breadth', 8, 2)->nullable();
            $table->float('height', 8, 2)->nullable();
            $table->float('weight', 8, 2)->nullable();
            $table->string('dimension_unit', 20)->nullable();
            $table->string('weight_unit', 20)->nullable();
            $table->string('availability', 64);
            $table->boolean('is_active');
            $table->foreignID('product_id')->constrained('products')->onUpdate('cascade')->onDelete('cascade');
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('mysql2')->dropIfExists('products_sku');
    }
}
