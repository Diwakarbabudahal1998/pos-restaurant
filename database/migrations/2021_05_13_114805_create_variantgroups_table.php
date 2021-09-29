<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVariantgroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('variantgroups', function (Blueprint $table) {
            $table->id();
            $table->string('variant_group_name');
            $table->string('sort_order');
            $table->json('variants');
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
        Schema::table('variantgroups', function (Blueprint $table) {
            $table->dropForeign('variantgroups_user_id_foreign');
            $table->dropColumn('user_id');
        });
        Schema::dropIfExists('variantgroups');
    }
}