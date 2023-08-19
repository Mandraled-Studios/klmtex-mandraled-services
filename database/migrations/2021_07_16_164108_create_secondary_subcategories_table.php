<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSecondarySubcategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql2')->create('secondary_subcategories', function (Blueprint $table) {
            $table->id();
            $table->string('name', 128);
            $table->string('metatitle')->nullable();
            $table->string('keywords')->nullable();
            $table->string('slug', 128)->unique();
            $table->text('description')->nullable();
            $table->string('hero_img_path')->nullable();
            $table->string('icon_path')->nullable();
            $table->boolean('is_active');
            $table->foreignID('subcategory_id')->constrained('subcategories')->onUpdate('cascade');
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
        Schema::connection('mysql2')->dropIfExists('secondary_subcategories');
    }
}
