<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableHocphisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hocphis', function (Blueprint $table) {
            $table->id();
            $table->integer('sinh_vien_id');
            $table->integer('so_tin_chi');
            $table->string('ma_hoc_ky');
            $table->integer('da_dong')->nullable();
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
        Schema::dropIfExists('hocphis');
    }
}
