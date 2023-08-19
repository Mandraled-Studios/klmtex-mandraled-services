<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string("company_name")->nullable();
            $table->string("gstin", 32)->nullable();
            $table->foreignId("address_id")->constrained('addresses');
            $table->string("logo")->nullable();
            $table->text("invoice_terms")->nullable();
            $table->text("quote_terms")->nullable();
            $table->text("payment_terms")->nullable();
            $table->string("signature")->nullable();
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
        Schema::dropIfExists('companies');
    }
}
