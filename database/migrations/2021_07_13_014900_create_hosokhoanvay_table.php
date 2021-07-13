<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHosokhoanvayTable extends Migration
{
    public function up()
    {
        Schema::create('hosokhoanvay', function (Blueprint $table) {
            $table->increments('hsk_id');
            $table->string('hsk_ma',20)->collation('utf8_unicode_ci');
            $table->string('hsk_ten',20)->collation('utf8_unicode_ci');
            $table->integer('hsk_kihan');
            $table->float('hsk_tongtien', 8, 2);
            $table->date('hsk_ngayvay');
            $table->float('hsk_laisuat', 8, 2);
        });
    }
    public function down()
    {
        Schema::dropIfExists('hosokhoanvay');
    }
}
