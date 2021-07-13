<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateThanhtoanTable extends Migration
{
    public function up()
    {
        Schema::create('thanhtoan', function (Blueprint $table) {
            $table->increments('tt_id');
            $table->string('tt_ma',20)->collation('utf8_unicode_ci')->nullable();    
            $table->date('tt_ngaygiaodich');
            $table->string('tt_stk',20)->collation('utf8_unicode_ci');    
            $table->float('tt_sotien', 8, 2);
            $table->string('tt_noidung',300)->collation('utf8_unicode_ci');
        });
    }
    public function down()
    {
        Schema::dropIfExists('thanhtoan');
    }
}
