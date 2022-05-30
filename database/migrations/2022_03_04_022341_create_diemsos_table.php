<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiemsosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('diemsos', function (Blueprint $table) {
            $table->id();
            $table->integer('mon_hoc_id');
            $table->integer('sinh_vien_id');
            $table->integer('giang_vien_id');
            $table->string('danh_gia', 15);    // Đạt, thi lại, học lại
            $table->double('chuyen_can');
            $table->double('giua_ky');
            $table->double('cuoi_ky');
            $table->double('diem_tong_ket');
            $table->string('diem_chu', 3);
            $table->integer('lan_hoc')->default(0);
            $table->integer('lan_thi')->default(0);
            $table->string('ma_hoc_ky', 20);
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
        Schema::dropIfExists('diemsos');
    }
}
