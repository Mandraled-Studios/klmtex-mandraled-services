<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVariantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql2')->create('variants', function (Blueprint $table) {
            $table->id();
            $table->string('name', 64);
            $table->foreignID('product_id')->constrained('products')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('sort_order');
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
        Schema::connection('mysql2')->dropIfExists('variants');
    }
}
