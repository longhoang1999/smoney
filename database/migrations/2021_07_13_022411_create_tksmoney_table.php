<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTksmoneyTable extends Migration
{
    public function up()
    {
        Schema::create('tksmoney', function (Blueprint $table) {
            $table->increments('tks_id');
            $table->string('tks_ma',16)->collation('utf8_unicode_ci')->nullable();
            $table->string('tks_sotk',20)->collation('utf8_unicode_ci')->nullable();
            $table->string('tks_tentk',50)->collation('utf8_unicode_ci')->nullable();
            $table->string('tks_sdt',12)->collation('utf8_unicode_ci');  
            $table->string('ths_mk',100)->collation('utf8_unicode_ci');  
            $table->integer('tks_loaitk');
            // 1. sinh viên 2. nhà trường 3. ngân hàng 4. admin
        });
    }
    public function down()
    {
        Schema::dropIfExists('tksmoney');
    }
}
