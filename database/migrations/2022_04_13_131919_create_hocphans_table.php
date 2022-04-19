<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHocphansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hocphans', function (Blueprint $table) {
            $table->id();
            $table->string('ma_hoc_phan');
            $table->integer('mon_hoc_id');
            $table->string('thoi_gian')->nullable();
            $table->string('dia_diem')->nullable();
            $table->integer('giang_vien_id')->nullable();
            $table->integer('dk_toi_da')->default(60);
            $table->integer('da_dang_ky')->nullable();
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
        Schema::dropIfExists('hocphans');
    }
}
