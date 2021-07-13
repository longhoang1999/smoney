<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNhatruongTable extends Migration
{
    public function up()
    {
        Schema::create('nhatruong', function (Blueprint $table) {
            $table->increments('nt_id');
            $table->string('nt_ma',20)->collation('utf8_unicode_ci')->nullable();
            $table->string('nt_ten',50)->collation('utf8_unicode_ci');
            $table->string('nt_diachi',100)->collation('utf8_unicode_ci');
            $table->string('nt_sdt',12)->collation('utf8_unicode_ci');
        });
    }
    public function down()
    {
        Schema::dropIfExists('nhatruong');
    }
}
