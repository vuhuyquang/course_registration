<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuantriviensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quantriviens', function (Blueprint $table) {
            $table->id();
            $table->string('ma_quan_tri_vien')->unique();
            $table->string('ho_ten');
            $table->string('trinh_do');
            $table->string('don_vi');
            $table->string('mat_khau');
            $table->date('ngay_sinh');
            $table->string('gioi_tinh');
            $table->string('que_quan');
            $table->string('email')->unique();
            $table->string('so_dien_thoai')->unique();
            $table->string('quyen')->default('admin');
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
        Schema::dropIfExists('quantriviens');
    }
}
