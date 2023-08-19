<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSettingsFieldToAttachments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql2')->table('attachments', function (Blueprint $table) {
            $table->foreignID('product_id')->constrained('products')->onUpdate('cascade')->onDelete('cascade');
            $table->string('setting1')->nullable();
            $table->string('setting2')->nullable();
            $table->string('setting3')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('attachments', function (Blueprint $table) {
            $table->dropColumn('product_id');
            $table->dropColumn('setting1');
            $table->dropColumn('setting2');
            $table->dropColumn('setting3');
        });
    }
}
