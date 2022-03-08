<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSvdksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('svdks', function (Blueprint $table) {
            $table->id();
            $table->string('mon_hoc_id');
            $table->string('sinh_vien_id');
            $table->string('giang_vien_id');
            $table->string('khoa_id');
            $table->string('lich_hoc');
            $table->string('dia_diem');
            $table->date('thoi_gian_dk');
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
        Schema::dropIfExists('svdks');
    }
}
