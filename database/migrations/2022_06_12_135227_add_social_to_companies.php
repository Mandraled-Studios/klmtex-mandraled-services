<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSocialToCompanies extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('companies', function (Blueprint $table) {
            $table->string("facebook")->nullable();
            $table->string("twitter")->nullable();
            $table->string("instagram")->nullable();
            $table->string("linkedin")->nullable();
            $table->string("youtube")->nullable();
            $table->string("whatsapp")->nullable();
            $table->string("social1")->nullable();
            $table->string("social1_url")->nullable();
            $table->string("social1_icon")->nullable();
            $table->string("social2")->nullable();
            $table->string("social2_url")->nullable();
            $table->string("social2_icon")->nullable();
            $table->string("social_style")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('companies', function (Blueprint $table) {
            //
        });
    }
}
