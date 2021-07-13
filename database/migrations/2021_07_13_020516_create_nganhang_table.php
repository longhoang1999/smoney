<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNganhangTable extends Migration
{
    public function up()
    {
        Schema::create('nganhang', function (Blueprint $table) {
            $table->increments('nn_id');
            $table->string('nn_ma',20)->collation('utf8_unicode_ci')->nullable();
            $table->string('nn_ten',50)->collation('utf8_unicode_ci');
            $table->string('nn_diachi',100)->collation('utf8_unicode_ci');
            $table->string('nn_sdt',12)->collation('utf8_unicode_ci');
            $table->string('nn_thongtin',1000)->collation('utf8_unicode_ci');
            $table->string('nn_chinhsach',1000)->collation('utf8_unicode_ci');
            $table->string('nn_hoatdong',300)->collation('utf8_unicode_ci');
        });
    }
    public function down()
    {
        Schema::dropIfExists('nganhang');
    }
}
