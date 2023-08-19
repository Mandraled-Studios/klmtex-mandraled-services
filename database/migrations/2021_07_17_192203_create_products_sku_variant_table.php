<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsSkuVariantTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql2')->create('products_sku_variant', function (Blueprint $table) {
            $table->id();
            $table->foreignID('products_sku_id')->constrained('products_sku')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignID('variant_id')->constrained('variants')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignID('variant_value_id')->constrained('variant_values')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::connection('mysql2')->dropIfExists('products_sku_variant');
    }
}
