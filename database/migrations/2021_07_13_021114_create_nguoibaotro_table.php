<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNguoibaotroTable extends Migration
{
    public function up()
    {
        Schema::create('nguoibaotro', function (Blueprint $table) {
            $table->increments('nbt_id');
            $table->string('nbt_ma',20)->collation('utf8_unicode_ci')->nullable();
            $table->integer('nbt_student_id');
            $table->string('nbt_hoten',100)->collation('utf8_unicode_ci');
            $table->string('nbt_sdt',12)->collation('utf8_unicode_ci');
            $table->string('nbt_cccd',20)->collation('utf8_unicode_ci');
            $table->string('nbt_gioitinh',10)->collation('utf8_unicode_ci');
            $table->string('nbt_stk',20)->collation('utf8_unicode_ci');
        });
    }

    public function down()
    {
        Schema::dropIfExists('nguoibaotro');
    }
}
