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
        Schema::connection('mysql2')->create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('metatitle')->nullable();
            $table->string('keywords')->nullable();
            $table->string('slug', 128)->unique();
            $table->string('short_description')->nullable();
            $table->text('long_description')->nullable();
            $table->string('thumbnail_path')->nullable();
            $table->string('tag1', 30)->nullable();
            $table->string('tag2', 30)->nullable();
            $table->boolean('is_active');
            $table->boolean('has_variants');
            $table->boolean('is_stock_monitored');
            $table->boolean('has_highlights');
            $table->boolean('has_banner');
            $table->boolean('has_attributes');
            $table->boolean('has_offers');
            $table->boolean('has_attachments');
            $table->boolean('allows_questions');
            $table->float('tax_slab', 5, 2)->nullable();
            $table->text('features')->nullable();
            $table->foreignID('productable_id');
            $table->string('productable_type');
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
        Schema::connection('mysql2')->dropIfExists('products');
    }
}
