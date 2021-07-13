<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateYeucauvayTable extends Migration
{
    public function up()
    {
        Schema::create('yeucauvay', function (Blueprint $table) {
            $table->increments('ycv_id');
            $table->string('ycv_ma',16)->collation('utf8_unicode_ci')->nullable();
            $table->integer('ycv_student_id');
            $table->string('ycv_stk',20)->collation('utf8_unicode_ci');
            $table->string('ycv_tentk',50)->collation('utf8_unicode_ci');
            $table->string('ycv_thanhtoan',50)->collation('utf8_unicode_ci');
            $table->float('ycv_sotien', 8, 2);  
            $table->integer('ycv_kihan');
            $table->float('ycv_laisuat', 8, 2);        
        });
    }
    public function down()
    {
        Schema::dropIfExists('yeucauvay');
    }
}
