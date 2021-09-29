<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddongroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addongroups', function (Blueprint $table) {
            $table->id();

            $table->string('addon_group_name');
            $table->string('sort_order')->nullable();
            $table->string('min_table')->default(0);
            $table->string('max_table');
            /* 
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade'); */
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
        /*  Schema::table('addongroups', function (Blueprint $table) {
            $table->dropForeign('addongroups_user_id_foreign');
            $table->dropColumn('user_id');
        }); */
        Schema::dropIfExists('addongroups');
    }
}