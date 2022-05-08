<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGiangviensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('giangviens', function (Blueprint $table) {
            $table->id();
            $table->string('ma_giang_vien', 20)->unique();
            $table->string('ho_ten', 50);
            $table->string('trinh_do');
            $table->integer('nganh_hoc_id');
            $table->date('ngay_sinh');
            $table->string('gioi_tinh');
            $table->string('que_quan', 80);
            $table->string('so_dien_thoai', 30)->nullable()->unique();
            $table->text('avatar')->default('avatar_default.png');
            $table->integer('tai_khoan_id');
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
        Schema::dropIfExists('giangviens');
    }
}
