<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTknganhangTable extends Migration
{
    public function up()
    {
        Schema::create('tknganhang', function (Blueprint $table) {
            $table->increments('tknn_id');
            $table->string('tknn_ma',16)->collation('utf8_unicode_ci')->nullable();    
            $table->string('tknn_tentk',20)->collation('utf8_unicode_ci');  
            $table->date('tknn_ngayhieuluc');  
            $table->string('tknn_loaitk',50)->collation('utf8_unicode_ci');
        });
    }
    public function down()
    {
        Schema::dropIfExists('tknganhang');
    }
}
