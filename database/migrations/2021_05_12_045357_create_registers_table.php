<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegistersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registers', function (Blueprint $table) {
            $table->id();
            $table->string('register_name');
            $table->string('receipt_number_prefix');
            $table->string('bill_header');
            $table->string('bill_footer');
            $table->string('printed_type');
            $table->boolean('print_receipt_order');
            $table->boolean('include_shop_logo');
            $table->string('table_number')->nullable();
            $table->string('server_ip_address')->nullable();
            $table->string('kds_state_time')->nullable();
            $table->boolean('accept_status_order');
            $table->boolean('served_status_order');
            $table->boolean('change_status_item');
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
        Schema::table('registers', function (Blueprint $table) {
            $table->dropForeign('registers_user_id_foreign');
            $table->dropColumn('user_id');
        });
        Schema::dropIfExists('registers');
    }
}