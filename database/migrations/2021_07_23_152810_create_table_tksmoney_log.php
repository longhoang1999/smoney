<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableTksmoneyLog extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tksmoney_log', function (Blueprint $table) {
            $table->increments('log_id');
            $table->string('log_id_user',10)->collation('utf8_unicode_ci');
            $table->string('log_token',100)->collation('utf8_unicode_ci');
            $table->string('log_ip_address',100)->collation('utf8_unicode_ci');
            $table->string('log_device_name',100)->collation('utf8_unicode_ci');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tksmoney_log');
    }
}
