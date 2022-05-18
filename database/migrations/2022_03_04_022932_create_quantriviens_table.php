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
            $table->string('ma_quan_tri_vien', 20)->unique();
            $table->string('ho_ten', 50);
            $table->string('trinh_do', 25);
            $table->string('don_vi', 50);
            $table->date('ngay_sinh');
            $table->string('gioi_tinh', 20);
            $table->string('que_quan', 80);
            $table->string('so_dien_thoai', 10)->nullable()->unique();
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
        Schema::dropIfExists('quantriviens');
    }
}
