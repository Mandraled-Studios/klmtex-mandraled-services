<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVariantValuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql2')->create('variant_values', function (Blueprint $table) {
            $table->id();
            $table->string('variant_value');
            $table->string('color_swatch')->nullable();
            $table->string('thumbnail_path')->nullable();
            $table->foreignID('variant_id')->constrained('variants')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::connection('mysql2')->dropIfExists('variant_values');
    }
}
