<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSinhviensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sinhviens', function (Blueprint $table) {
            $table->id();
            $table->string('ma_sinh_vien', 20)->unique();
            $table->string('ho_ten', 50);
            $table->integer('khoa_hoc_id');
            $table->integer('lop_hoc_id');
            $table->integer('nganh_hoc_id');
            $table->string('ngay_sinh', 50)->nullable();
            $table->string('gioi_tinh', 10);
            $table->string('que_quan', 80);
            $table->string('so_dien_thoai', 10)->nullable()->unique();
            $table->text('avatar')->default('avatar_default.png');
            $table->integer('tai_khoan_id');
            $table->integer('so_ky_hoc')->default(0);
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
        Schema::dropIfExists('sinhviens');
    }
}
