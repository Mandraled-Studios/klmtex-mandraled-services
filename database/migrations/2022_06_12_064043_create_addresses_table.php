<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->string("country"); 
            $table->string("zipcode")->nullable(); 
            $table->string("state"); 
            $table->string("city"); 
            $table->string("area")->nullable(); 
            $table->string("street")->nullable(); 
            $table->string("landmark")->nullable(); 
            $table->string("floor")->nullable(); 
            $table->string("building_no")->nullable(); 
            $table->string("address_type")->nullable();
            $table->timestamps();
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
        Schema::dropIfExists('addresses');
    }
}
